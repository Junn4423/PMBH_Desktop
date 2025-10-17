import axios from 'axios';
import { url_api_services, url_login_api, url_api_logout, environment } from './url';

const urlApi = url_api_services;
const urlLoginApi = url_login_api;
const urlLogoutApi = url_api_logout;

const TOKEN_TTL_MS = 60 * 60 * 1000; // 1 hour
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
  return authCache;
};

const requestLoginToken = async (credentials) => {
  const res = await axios.post(urlLoginApi, credentials, LOGIN_REQUEST_CONFIG);
  const result = res.data;

  if (!result || !result.token || !result.code) {
    throw new Error(result?.message || 'Invalid GMAC response');
  }

  return cacheAuthResult(result);
};

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
    return res.data;
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

export default {
  login,
  getAuthHeaders,
  clearAuthCache,
  authDebug,
  environment,
  callApiWithAuth,
  urlLogoutApi,
};
