const { createProxyMiddleware } = require('http-proxy-middleware');

// API server (both auth and services)
const API_PROXY_TARGET = process.env.PMBH_API_PROXY_TARGET || 'http://192.168.1.19';
const API_PROXY_PATH = '/services';

const DISABLE_PROXY = process.env.REACT_APP_DISABLE_DEV_PROXY === 'true';
const PROXY_LOG_LEVEL = process.env.PMBH_PROXY_LOG_LEVEL || 'warn';

const CHART_PROXY_PATH = process.env.REACT_APP_CHART_PROXY_PATH;
const CHART_PROXY_TARGET =
  process.env.PMBH_CHART_PROXY_TARGET ||
  process.env.REACT_APP_CHART_API_URL;

module.exports = function setupProxy(app) {
  if (!DISABLE_PROXY) {
    // Proxy for all API requests -> 192.168.1.19
    app.use(
      [API_PROXY_PATH, `${API_PROXY_PATH}/**`],
      createProxyMiddleware({
        target: API_PROXY_TARGET,
        changeOrigin: true,
        secure: false,
        logLevel: PROXY_LOG_LEVEL,
        onError(err, req, res) {
          console.error('API proxy error:', err.message);
          if (!res.headersSent) {
            res.writeHead(500, { 'Content-Type': 'text/plain' });
          }
          res.end('API proxy error: ' + err.message);
        },
        onProxyRes(proxyRes) {
          proxyRes.headers['Access-Control-Allow-Origin'] = '*';
          proxyRes.headers['Access-Control-Allow-Methods'] = 'GET,PUT,POST,DELETE,OPTIONS';
          proxyRes.headers['Access-Control-Allow-Headers'] =
            'Content-Type, Authorization, SOF-User-Token, X-User-Token, X-USER-CODE, X-USER-TOKEN';
        },
      })
    );
  }

  if (!DISABLE_PROXY && CHART_PROXY_PATH && CHART_PROXY_TARGET) {
    app.use(
      [CHART_PROXY_PATH, `${CHART_PROXY_PATH}/**`],
      createProxyMiddleware({
        target: CHART_PROXY_TARGET,
        changeOrigin: true,
        secure: false,
        logLevel: PROXY_LOG_LEVEL,
        pathRewrite: { [`^${CHART_PROXY_PATH}`]: '' },
        onError(err, req, res) {
          console.error('Chart proxy error:', err.message);
          if (!res.headersSent) {
            res.writeHead(500, { 'Content-Type': 'text/plain' });
          }
          res.end('Chart proxy error: ' + err.message);
        },
      })
    );
  }
};
