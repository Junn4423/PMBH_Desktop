import axios from 'axios';
import { url_api_services, url_login_api, url_api_logout, environment } from './url';

const urlApi = url_api_services;
const urlLoginApi = url_login_api;
const urlLogoutApi = url_api_logout;

const TOKEN_TTL_MS = 60 * 60 * 1000; // 1 hour
const TOKEN_REFRESH_THRESHOLD_MS = 5 * 60 * 1000; // Refresh 5 minutes before expiry
const AUTO_REFRESH_RETRY_DELAY_MS = 30 * 1000;
const MIN_REFRESH_DELAY_MS = 5 * 1000;
const LOGIN_REQUEST_CONFIG = {
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
  },
  timeout: 5000,
};

let authCache = null;
let authExpiry = null;
let lastCredentials = null;
let refreshPromise = null;
let autoRefreshTimer = null;
let autoRefreshEnabled = false;

const isInvalidAuthResponse = (data) => {
  if (data === null || data === undefined) {
    return false;
  }

  if (typeof data === 'string') {
    const normalized = data.toLowerCase();
    return normalized === 'invalid' || normalized.includes('invalid token');
  }

  const message = data.message || data.error || data.statusMessage;
  if (!message) {
    return false;
  }

  const normalizedMessage = String(message).toLowerCase();
  return normalizedMessage === 'invalid' || normalizedMessage.includes('invalid token');
};

function clearAutoRefreshTimer() {
  if (autoRefreshTimer) {
    clearTimeout(autoRefreshTimer);
    autoRefreshTimer = null;
  }
}

function scheduleAutoRefresh() {
  clearAutoRefreshTimer();

  if (!autoRefreshEnabled || !authExpiry || !lastCredentials) {
    return;
  }

  const now = Date.now();
  let refreshDelay = authExpiry - TOKEN_REFRESH_THRESHOLD_MS - now;

  if (!Number.isFinite(refreshDelay) || refreshDelay <= 0) {
    refreshDelay = MIN_REFRESH_DELAY_MS;
  }

  autoRefreshTimer = setTimeout(async () => {
    try {
      await getAuthToken(true);
    } catch (error) {
      console.error('Automatic token refresh failed, will retry shortly:', error?.message || error);
      autoRefreshTimer = setTimeout(scheduleAutoRefresh, AUTO_REFRESH_RETRY_DELAY_MS);
      return;
    }

    scheduleAutoRefresh();
  }, refreshDelay);
}

const buildCredentialsPayload = (username, password) => ({
  txtUserName: username,
  txtPassword: password,
});

const cacheAuthResult = (result) => {
  authCache = {
    token: result.token,
    code: result.code,
    userId: result.userId || 1,
    role: result.role,
    chiNhanh: result.chiNhanh,
  };
  authExpiry = Date.now() + TOKEN_TTL_MS;
  scheduleAutoRefresh();
  return authCache;
};

const requestLoginToken = async (credentials) => {
  if (!credentials) {
    throw new Error('Missing credentials for login request');
  }

  if (refreshPromise) {
    return refreshPromise;
  }

  refreshPromise = (async () => {
    const res = await axios.post(urlLoginApi, credentials, LOGIN_REQUEST_CONFIG);
    const result = res.data;

    if (!result || !result.token || !result.code) {
      throw new Error(result?.message || 'Invalid GMAC response');
    }

    return cacheAuthResult(result);
  })();

  try {
    return await refreshPromise;
  } finally {
    refreshPromise = null;
  }
};

export function startTokenAutoRefresh() {
  autoRefreshEnabled = true;
  scheduleAutoRefresh();
}

export function stopTokenAutoRefresh() {
  autoRefreshEnabled = false;
  clearAutoRefreshTimer();
}

export async function refreshAuthToken() {
  return getAuthToken(true);
}

async function getAuthToken(forceRefresh = false) {
  if (!forceRefresh && authCache && authExpiry && Date.now() < authExpiry) {
    return authCache;
  }

  if (!lastCredentials) {
    throw new Error('Invalid session. Please log in again.');
  }

  try {
    return await requestLoginToken(lastCredentials);
  } catch (error) {
    console.error('GMAC server not available:', error.message);
    authCache = null;
    authExpiry = null;
    throw new Error('Cannot reach GMAC server');
  }
}

export async function getAuthHeaders(forceRefresh = false) {
  try {
    const authData = await getAuthToken(forceRefresh);
    return {
      'Content-Type': 'application/json',
      Authorization: `Bearer ${authData.token}`,
      'X-USER-CODE': authData.code,
      'X-USER-TOKEN': authData.token,
    };
  } catch (error) {
    console.error('Failed to get auth headers:', error);
    return {
      'Content-Type': 'application/json',
    };
  }
}

async function callApiWithAuth(payload, retryCount = 0) {
  try {
    const headers = await getAuthHeaders(retryCount > 0);
    const res = await axios.post(urlApi, payload, { headers });
    const data = res.data;

    if (isInvalidAuthResponse(data)) {
      if (retryCount === 0) {
        try {
          await refreshAuthToken();
        } catch (refreshError) {
          console.error('Failed to refresh token after invalid GMAC response:', refreshError);
          throw refreshError;
        }
        return callApiWithAuth(payload, 1);
      }

      throw new Error('Authentication token invalid after retry');
    }

    return data;
  } catch (error) {
    if (error.response && error.response.status === 401 && retryCount === 0) {
      authCache = null;
      authExpiry = null;
      return callApiWithAuth(payload, 1);
    }
    throw error;
  }
}

export async function login(username, password) {
  const credentials = buildCredentialsPayload(username, password);
  lastCredentials = credentials;

  try {
    const authData = await requestLoginToken(credentials);
    startTokenAutoRefresh();

    return {
      success: true,
      token: authData.token,
      userCode: authData.code,
      role: authData.role,
      chiNhanh: authData.chiNhanh,
    };
  } catch (error) {
    console.error('Login error:', error.response ? error.response.data : error.message);
    if (error.response) {
      console.error('Response status:', error.response.status);
      console.error('Response headers:', error.response.headers);
    }
    throw new Error('Login failed');
  }
}

export function clearAuthCache() {
  stopTokenAutoRefresh();
  authCache = null;
  authExpiry = null;
  lastCredentials = null;
}

export const authDebug = {
  get cache() {
    return authCache;
  },
  get expiresAt() {
    return authExpiry;
  },
  get hasCredentials() {
    return Boolean(lastCredentials);
  },
};

const apiLoginService = {
  login,
  getAuthHeaders,
  clearAuthCache,
  startTokenAutoRefresh,
  stopTokenAutoRefresh,
  refreshAuthToken,
  authDebug,
  environment,
  callApiWithAuth,
  urlLogoutApi,
};

export default apiLoginService;
