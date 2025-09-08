// Detect environment
const isElectron = () => {
  // Check if we're in Electron renderer process
  if (typeof window !== 'undefined' && window.process && window.process.type === 'renderer') {
    return true;
  }
  // Check if we're in Electron main process
  if (typeof process !== 'undefined' && process.versions && process.versions.electron) {
    return true;
  }
  // Check for electron in user agent
  if (typeof navigator !== 'undefined' && navigator.userAgent.toLowerCase().indexOf('electron') > -1) {
    return true;
  }
  return false;
};

const isElectronEnv = isElectron();
const isDevelopment = process.env.NODE_ENV === 'development';

// API URLs Configuration
let baseUrl, loginUrl, logoutUrl, servicesUrl;

if (isElectronEnv) {
  // Direct URLs for Electron (no CORS issues)
  baseUrl = "http://localhost/gmac";
  loginUrl = "http://localhost/gmac/login.sof.vn/index.php";
  logoutUrl = "http://localhost/gmac/signout.sof.vn/index.php";
  servicesUrl = "http://localhost/gmac/services.sof.vn/index.php";
} else {
  // Proxy URLs for web browser (to avoid CORS)
  baseUrl = "/gmac";
  loginUrl = "/gmac/login.sof.vn/index.php";
  logoutUrl = "/gmac/signout.sof.vn/index.php";
  servicesUrl = "/gmac/services.sof.vn/index.php";
}

export const url_api_services = servicesUrl;
export const url_login_api = loginUrl;
export const url_api_logout = logoutUrl;
export const url_api = baseUrl;

// Export environment info for debugging
export const environment = {
  isElectron: isElectronEnv,
  isDevelopment,
  baseUrl,
  loginUrl,
  logoutUrl,
  servicesUrl
};
