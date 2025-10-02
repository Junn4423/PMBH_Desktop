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

let chartUrl;

if (isElectronEnv) {
  // Direct URLs for Electron (no CORS issues)
  baseUrl = "http://192.168.1.92/gmac";
  loginUrl = "http://192.168.1.92/gmac/login.sof.vn/index.php";
  logoutUrl = "http://192.168.1.92/gmac/signout.sof.vn/index.php";
  servicesUrl = "http://192.168.1.92/gmac/services.sof.vn/index.php";
  chartUrl = "http://192.168.1.91:5000/areaCharts";
} else {
  // For development in browser, use proxy URLs
  // The proxy in package.json will redirect these to http://localhost
  baseUrl = "/gmac";
  loginUrl = "/gmac/login.sof.vn/index.php";
  logoutUrl = "/gmac/signout.sof.vn/index.php";
  servicesUrl = "/gmac/services.sof.vn/index.php";
  chartUrl = "http://192.168.1.91:5000/areaCharts";
}

export const url_api_services = servicesUrl;
export const url_login_api = loginUrl;
export const url_api_logout = logoutUrl;
export const url_api = baseUrl;
export const url_chart_api = chartUrl;

// Export environment info for debugging
export const environment = {
  isElectron: isElectronEnv,
  isDevelopment,
  baseUrl,
  loginUrl,
  logoutUrl,
  servicesUrl,
  chartUrl
};
