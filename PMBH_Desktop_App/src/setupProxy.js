const { createProxyMiddleware } = require('http-proxy-middleware');

module.exports = function(app) {
  console.log('Setting up proxy middleware...');

  // Proxy cho API gmac - tạm thời comment out vì dùng proxy trong package.json
  // app.use(
  //   '/api/gmac',
  //   createProxyMiddleware({
  //     target: 'http://localhost/gmac', // Target to the gmac directory
  //     changeOrigin: true,
  //     pathRewrite: {
  //       '^/api/gmac': '', // Remove /api/gmac prefix
  //     },
  //     onError: function (err, req, res) {
  //       console.error('Proxy error:', err);
  //       res.writeHead(500, {
  //         'Content-Type': 'text/plain',
  //       });
  //       res.end('Proxy error: ' + err.message);
  //     },
  //     onProxyReq: function (proxyReq, req, res) {
  //       console.log('Proxying request:', req.method, req.url, '-> http://localhost/gmac' + req.url.replace('/api/gmac', ''));
  //     },
  //     onProxyRes: function (proxyRes, req, res) {
  //       console.log('Proxy response:', proxyRes.statusCode, req.url);
  //       // Add CORS headers
  //       proxyRes.headers['Access-Control-Allow-Origin'] = '*';
  //       proxyRes.headers['Access-Control-Allow-Methods'] = 'GET,PUT,POST,DELETE,OPTIONS';
  //       proxyRes.headers['Access-Control-Allow-Headers'] = 'Content-Type, Authorization, Content-Length, X-Requested-With, X-USER-CODE, X-USER-TOKEN';
  //     },
  //     logLevel: 'debug'
  //   })
  // );

  console.log('Proxy middleware setup complete');
};
