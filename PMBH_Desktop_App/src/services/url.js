import { isElectron, isDevelopment, normalizeOrigin } from '../utils/environment';

// API paths - new structure
const API_BASE_PATH = '/services/v2.cafe.banhangonline.top';
const LOGIN_PATH = `${API_BASE_PATH}/login/`;
const LOGOUT_PATH = `${API_BASE_PATH}/signout/`;
const SESSION_STATUS_PATH = `${API_BASE_PATH}/login/`; // Use login endpoint for session check
const SERVICES_PATH = `${API_BASE_PATH}/services/index.php`;

// Both auth and services are on the same server (192.168.1.19)
const DEFAULT_API_ORIGIN = normalizeOrigin(process.env.REACT_APP_API_ORIGIN || 'http://192.168.1.19');
const DEFAULT_IMAGE_ORIGIN = normalizeOrigin(process.env.REACT_APP_IMAGE_ORIGIN || DEFAULT_API_ORIGIN);
const DEFAULT_CHART_URL = process.env.REACT_APP_CHART_API_URL || 'http://192.168.1.91:5000/areaCharts';
const CHART_PROXY_PATH = process.env.REACT_APP_CHART_PROXY_PATH || '';

const shouldUseDevProxy = !isElectron && isDevelopment && process.env.REACT_APP_DISABLE_DEV_PROXY !== 'true';

// Dynamic API configuration from login response
let dynamicApiConfig = null;

export const setDynamicApiConfig = (config) => {
  if (config && config.domain && config.method) {
    dynamicApiConfig = {
      domain: config.domain,
      method: config.method,
      origin: `${config.method}://${config.domain}`,
    };
    console.log('Dynamic API config set:', dynamicApiConfig);
  } else {
    dynamicApiConfig = null;
  }
};

export const clearDynamicApiConfig = () => {
  dynamicApiConfig = null;
};

export const getDynamicApiConfig = () => dynamicApiConfig;

// In dev mode with proxy, use relative paths; in Electron use full URLs
// If dynamic config exists, use it; otherwise fall back to default
const getApiOrigin = () => {
  if (shouldUseDevProxy) {
    return '';
  }
  return dynamicApiConfig ? dynamicApiConfig.origin : DEFAULT_API_ORIGIN;
};

const getImageOrigin = () => {
  if (shouldUseDevProxy) {
    return '';
  }
  return dynamicApiConfig ? dynamicApiConfig.origin : DEFAULT_IMAGE_ORIGIN;
};

const buildUrl = (origin, path) => {
  if (!origin) {
    return path;
  }

  if (!path.startsWith('/')) {
    return `${origin}/${path}`;
  }

  return `${origin}${path}`;
};

// Build URLs using dynamic config when available
export const buildApiUrl = (path) => buildUrl(getApiOrigin(), path);
export const buildImageUrl = (path) => buildUrl(getImageOrigin(), path);

// All URLs go to same server (192.168.1.19 by default, or dynamic from login)
export const getLoginUrl = () => buildApiUrl(LOGIN_PATH);
export const getLogoutUrl = () => buildApiUrl(LOGOUT_PATH);
export const getSessionStatusUrl = () => buildApiUrl(SESSION_STATUS_PATH);
export const getServicesUrl = () => buildApiUrl(SERVICES_PATH);
export const getBaseUrl = () => buildApiUrl(API_BASE_PATH);
export const getImageBaseUrl = () => buildImageUrl(API_BASE_PATH);

// Static URLs for initial login (before dynamic config is set)
const loginUrl = buildUrl(shouldUseDevProxy ? '' : DEFAULT_API_ORIGIN, LOGIN_PATH);
const logoutUrl = buildUrl(shouldUseDevProxy ? '' : DEFAULT_API_ORIGIN, LOGOUT_PATH);
const sessionStatusUrl = buildUrl(shouldUseDevProxy ? '' : DEFAULT_API_ORIGIN, SESSION_STATUS_PATH);
const servicesUrl = buildUrl(shouldUseDevProxy ? '' : DEFAULT_API_ORIGIN, SERVICES_PATH);
const baseUrl = buildUrl(shouldUseDevProxy ? '' : DEFAULT_API_ORIGIN, API_BASE_PATH);
const imageBaseUrl = buildUrl(shouldUseDevProxy ? '' : DEFAULT_IMAGE_ORIGIN, API_BASE_PATH);

const chartUrl = shouldUseDevProxy && CHART_PROXY_PATH
  ? CHART_PROXY_PATH
  : DEFAULT_CHART_URL;

// Export static URLs (used before login)
export const url_api_services = servicesUrl;
export const url_login_api = loginUrl;
export const url_api_logout = logoutUrl;
export const url_session_status = sessionStatusUrl;
export const url_api = baseUrl;
export const url_chart_api = chartUrl;
export const url_image_base = imageBaseUrl;

export const environment = {
  isElectron,
  isDevelopment,
  usesDevProxy: shouldUseDevProxy,
  apiOrigin: shouldUseDevProxy ? 'relative' : DEFAULT_API_ORIGIN,
  imageOrigin: shouldUseDevProxy ? 'relative' : DEFAULT_IMAGE_ORIGIN,
  baseUrl,
  loginUrl,
  logoutUrl,
  sessionStatusUrl,
  servicesUrl,
  chartUrl,
  imageBaseUrl,
  getDynamicOrigin: () => dynamicApiConfig ? dynamicApiConfig.origin : null,
};
