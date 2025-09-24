const { createProxyMiddleware } = require('http-proxy-middleware');

module.exports = function(app) {
  // Silent console

  // Proxy cho API gmac - để xử lý CORS
  app.use(
    '/gmac',
    createProxyMiddleware({
      target: 'http://localhost', // Target to localhost
      changeOrigin: true,
      onError: function (err, req, res) {
        console.error('Proxy error:', err);
        res.writeHead(500, {
          'Content-Type': 'text/plain',
        });
        res.end('Proxy error: ' + err.message);
      },
      onProxyReq: function (proxyReq, req, res) {
  // Silent console
      },
      onProxyRes: function (proxyRes, req, res) {
  // Silent console
        // Add CORS headers
        proxyRes.headers['Access-Control-Allow-Origin'] = '*';
        proxyRes.headers['Access-Control-Allow-Methods'] = 'GET,PUT,POST,DELETE,OPTIONS';
        proxyRes.headers['Access-Control-Allow-Headers'] = 'Content-Type, Authorization, Content-Length, X-Requested-With, X-USER-CODE, X-USER-TOKEN';
      },
      logLevel: 'debug'
    })
  );

  // Silent console
};
