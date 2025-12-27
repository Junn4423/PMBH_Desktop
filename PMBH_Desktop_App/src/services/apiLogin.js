import axios from 'axios';
import { url_login_api, environment, url_session_status, getServicesUrl, getLogoutUrl, getSessionStatusUrl } from './url';

const urlApi = getServicesUrl;
const urlLoginApi = url_login_api;
const urlLogoutApi = getLogoutUrl;

const TOKEN_TTL_MS = 60 * 60 * 1000; // 1 hour
const TOKEN_REFRESH_THRESHOLD_MS = 5 * 60 * 1000; // Refresh 5 minutes before expiry
const AUTO_REFRESH_RETRY_DELAY_MS = 30 * 1000;
const MIN_REFRESH_DELAY_MS = 5 * 1000;

// Static auth headers for API authentication
const AUTH_HEADERS = {
  'SOF-User-Token': 'SOF2025DEVELOPER',
  'X-User-Token': 'CkL3E1E4Tpyj848O',
  'Content-Type': 'application/json',
  Accept: 'application/json',
};

const LOGIN_REQUEST_CONFIG = {
  headers: AUTH_HEADERS,
  timeout: 5000,
};

let authCache = null;
let authExpiry = null;
let lastCredentials = null;
let refreshPromise = null;
let autoRefreshTimer = null;
let autoRefreshEnabled = false;
let sessionConflictHandler = null;
const SESSION_CONFLICT_CODE = 'session_conflict';
const SESSION_STATUS_ACTION = 'session_status';

const normalizeSessionStatusResponse = (data) => {
  if (!data || typeof data !== 'object') {
    return {
      success: false,
      valid: false,
      message: data && data.message ? data.message : 'invalid_response',
    };
  }

  if (typeof data.valid === 'boolean') {
    return data;
  }

  if (String(data.message || '').toLowerCase() === SESSION_CONFLICT_CODE) {
    return {
      ...data,
      success: false,
      valid: false,
      message: SESSION_CONFLICT_CODE,
    };
  }

  return {
    ...data,
    valid: Boolean(data.success),
  };
};

const shouldAttemptSessionStatusFallback = (error) => {
  if (!error) {
    return false;
  }

  if (!error.response) {
    return true;
  }

  const status = error.response.status;
  return status === 404 || status === 500 || status === 0;
};

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

const isSessionConflictResponse = (data) => {
  if (!data) {
    return false;
  }
  const message = typeof data === 'string' ? data : data.message || data.error || data.statusMessage;
  if (!message) {
    return false;
  }
  return String(message).toLowerCase() === SESSION_CONFLICT_CODE;
};

export const setSessionConflictHandler = (handler) => {
  sessionConflictHandler = typeof handler === 'function' ? handler : null;
};

const notifySessionConflict = (message) => {
  if (typeof sessionConflictHandler === 'function') {
    try {
      sessionConflictHandler(message);
    } catch (notifyError) {
      console.error('Session conflict handler failed:', notifyError);
    }
  }
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

const buildCredentialsPayload = (username, password, deviceType = 'desktop') => ({
  txtUserName: username,
  txtPassword: password,
  txtDeviceType: deviceType,
});

const cacheAuthResult = (result) => {
  authCache = {
    token: result.token,
    code: result.code,
    userId: result.userId || 1,
    role: result.role,
    chiNhanh: result.chiNhanh,
    deviceType: result.deviceType,
  };
  authExpiry = Date.now() + TOKEN_TTL_MS;
  scheduleAutoRefresh();
  return authCache;
};

const performLoginHandshake = async (credentials, options = {}) => {
  const payload = {
    ...credentials,
  };

  if (options.forceLogout) {
    payload.forceLogout = true;
  }

  if (options.currentToken) {
    payload.currentToken = options.currentToken;
  }

  const res = await axios.post(urlLoginApi, payload, LOGIN_REQUEST_CONFIG);
  return res.data;
};

const requestLoginToken = async (credentials, options = {}) => {
  if (!credentials) {
    throw new Error('Missing credentials for login request');
  }

  if (refreshPromise) {
    return refreshPromise;
  }

  refreshPromise = (async () => {
    const result = await performLoginHandshake(credentials, options);

    if (result?.requiresForceLogout) {
      throw new Error('force_logout_required');
    }

    if (!result || !result.token || !result.code) {
      throw new Error(result?.message || 'Invalid API response');
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
    return await requestLoginToken(lastCredentials, { currentToken: authCache?.token });
  } catch (error) {
    console.error('API server not available:', error.message);
    authCache = null;
    authExpiry = null;
    throw new Error('Cannot reach API server');
  }
}

export async function getAuthHeaders(forceRefresh = false) {
  // Return static auth headers with user token if available
  try {
    const authData = await getAuthToken(forceRefresh);
    return {
      ...AUTH_HEADERS,
      'X-USER-CODE': authData.code,
      'X-USER-TOKEN': authData.token,
    };
  } catch (error) {
    // Fallback to static headers without user token
    return {
      ...AUTH_HEADERS,
    };
  }
}

async function callApiWithAuth(payload, retryCount = 0) {
  try {
    const headers = await getAuthHeaders(retryCount > 0);
    const apiUrl = typeof urlApi === 'function' ? urlApi() : urlApi;
    const res = await axios.post(apiUrl, payload, { headers });
    const data = res.data;

    if (isSessionConflictResponse(data)) {
      clearAuthCache();
      notifySessionConflict('Tài khoản được đăng nhập ở nơi khác. Vui lòng đăng nhập lại.');
      const conflictError = new Error(SESSION_CONFLICT_CODE);
      conflictError.code = SESSION_CONFLICT_CODE;
      throw conflictError;
    }

    if (isInvalidAuthResponse(data)) {
      if (retryCount === 0) {
        try {
          await refreshAuthToken();
        } catch (refreshError) {
          console.error('Failed to refresh token after invalid API response:', refreshError);
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

export async function login(username, password, options = {}) {
  const credentials = buildCredentialsPayload(username, password, options.deviceType || 'desktop');
  lastCredentials = credentials;

  try {
    const handshakeResponse = await performLoginHandshake(credentials, {
      forceLogout: Boolean(options.forceLogout),
      currentToken: options.currentToken || authCache?.token,
    });

    if (handshakeResponse?.requiresForceLogout) {
      return {
        success: false,
        requiresForceLogout: true,
        message: handshakeResponse.message,
        code: handshakeResponse.code,
        chiNhanh: handshakeResponse.chiNhanh,
      };
    }

    if (!handshakeResponse || !handshakeResponse.token || !handshakeResponse.code) {
      return {
        success: false,
        message: handshakeResponse?.message || 'Đăng nhập thất bại',
        error_code: handshakeResponse?.error_code,
      };
    }

    const authData = cacheAuthResult(handshakeResponse);
    startTokenAutoRefresh();

    // Prefer domain/method from server response; fallback to current login URL
    let domainFromUrl = null;
    let methodFromUrl = null;
    try {
      const base = (typeof window !== 'undefined' && window?.location?.origin) || environment?.apiOrigin || 'http://localhost';
      const loginUrl = typeof urlLoginApi === 'function' ? urlLoginApi() : urlLoginApi;
      const apiUrl = new URL(loginUrl, base);
      domainFromUrl = apiUrl.hostname + (apiUrl.port ? ':' + apiUrl.port : '');
      methodFromUrl = apiUrl.protocol.replace(':', '');
    } catch (e) {
      // Silent fallback if URL parsing fails
      domainFromUrl = null;
      methodFromUrl = null;
    }

    const domain = handshakeResponse?.domain || domainFromUrl;
    const method = handshakeResponse?.method || methodFromUrl;

    return {
      success: true,
      token: authData.token,
      userCode: authData.code,
      role: authData.role,
      chiNhanh: authData.chiNhanh,
      deviceType: authData.deviceType,
      domain,
      method,
    };
  } catch (error) {
    const responseData = error.response?.data;
    const messageFromServer = responseData?.message;
    const status = error.response?.status;
    const headers = error.response?.headers;

    console.error('Login error:', messageFromServer || error.message);
    if (status) {
      console.error('Response status:', status);
    }
    if (headers) {
      console.error('Response headers:', headers);
    }

    return {
      success: false,
      message: messageFromServer || error.message || 'Đăng nhập thất bại',
      error_code: responseData?.error_code,
      status,
    };
  }
}

export async function performLogout(username, token, deviceType = 'desktop') {
  const payload = {
    txtUserName: username,
    txtToken: token,
    txtDeviceType: deviceType,
  };

  try {
    const logoutUrl = typeof urlLogoutApi === 'function' ? urlLogoutApi() : urlLogoutApi;
    const res = await axios.post(logoutUrl, payload, LOGIN_REQUEST_CONFIG);
    return res.data;
  } catch (error) {
    console.error('Logout API error:', error);
    return { success: false, message: error.message };
  }
}

export function clearAuthCache() {
  stopTokenAutoRefresh();
  authCache = null;
  authExpiry = null;
  lastCredentials = null;
}

export async function verifySession(code, token) {
  if (!code || !token) {
    throw new Error('missing_session_info');
  }

  const payload = {
    code,
    token,
  };

  try {
    const sessionUrl = typeof getSessionStatusUrl === 'function' ? getSessionStatusUrl() : url_session_status;
    const res = await axios.post(sessionUrl, payload, LOGIN_REQUEST_CONFIG);
    return normalizeSessionStatusResponse(res.data);
  } catch (error) {
    if (!shouldAttemptSessionStatusFallback(error)) {
      throw error;
    }

    const fallbackPayload = {
      ...payload,
      action: SESSION_STATUS_ACTION,
    };

    const fallbackResponse = await axios.post(
      urlLoginApi,
      fallbackPayload,
      LOGIN_REQUEST_CONFIG
    );
    return normalizeSessionStatusResponse(fallbackResponse.data);
  }
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
  performLogout,
  getAuthHeaders,
  clearAuthCache,
  verifySession,
  startTokenAutoRefresh,
  stopTokenAutoRefresh,
  refreshAuthToken,
  authDebug,
  environment,
  callApiWithAuth,
  get urlLogoutApi() {
    return typeof urlLogoutApi === 'function' ? urlLogoutApi() : urlLogoutApi;
  },
  setSessionConflictHandler,
};

export default apiLoginService;
