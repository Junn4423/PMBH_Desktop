const { app, BrowserWindow, Menu, ipcMain, dialog, shell } = require('electron');
const path = require('path');
const isDev = require('electron-is-dev');
const IPCHandlers = require('./ipcHandlers');
const { URL } = require('url');

let mainWindow;
let ipcHandlers;
let customerDisplayWindow = null;
let vnpayPaymentWindow = null;
let vnpayPaymentParent = null;
let vnpayReturnUrl = null;

const notifyVNPayParent = (payload) => {
  if (vnpayPaymentParent && !vnpayPaymentParent.isDestroyed()) {
    vnpayPaymentParent.send('vnpay:payment-result', payload);
  }
};

const closeVNPayPaymentWindow = () => {
  if (vnpayPaymentWindow && !vnpayPaymentWindow.isDestroyed()) {
    vnpayPaymentWindow.close();
  }
  vnpayPaymentWindow = null;
  vnpayPaymentParent = null;
  vnpayReturnUrl = null;
};

const handleVNPayReturnUrl = (targetUrl) => {
  if (!targetUrl || !vnpayReturnUrl) {
    return false;
  }

  try {
    const normalizedReturn = vnpayReturnUrl.trim();
    if (!normalizedReturn) {
      return false;
    }

    const parsedTarget = new URL(targetUrl);
    const parsedReturn = new URL(normalizedReturn, parsedTarget.origin);

    if (parsedTarget.origin !== parsedReturn.origin) {
      return false;
    }

    if (!parsedTarget.pathname.startsWith(parsedReturn.pathname)) {
      return false;
    }

    const queryEntries = Object.fromEntries(parsedTarget.searchParams.entries());

    notifyVNPayParent({
      source: 'vnpay-window',
      url: targetUrl,
      query: queryEntries,
    });

    closeVNPayPaymentWindow();
    return true;
  } catch (error) {
    console.error('Failed to process VNPay return URL:', error);
    notifyVNPayParent({
      source: 'vnpay-window',
      error: error.message,
      url: targetUrl,
    });
    closeVNPayPaymentWindow();
    return false;
  }
};

const openVNPayPaymentWindow = ({ paymentUrl, returnUrl }, sender) => {
  try {
    if (!paymentUrl) {
      throw new Error('Missing VNPay payment URL');
    }

    vnpayPaymentParent = sender;
    vnpayReturnUrl = returnUrl || null;

    if (vnpayPaymentWindow && !vnpayPaymentWindow.isDestroyed()) {
      vnpayPaymentWindow.loadURL(paymentUrl);
      vnpayPaymentWindow.focus();
      return { success: true };
    }

    vnpayPaymentWindow = new BrowserWindow({
      width: 480,
      height: 720,
      minWidth: 360,
      minHeight: 640,
      show: false,
      backgroundColor: '#ffffff',
      autoHideMenuBar: true,
      parent: mainWindow ?? undefined,
      modal: false,
      webPreferences: {
        contextIsolation: true,
        nodeIntegration: false,
        sandbox: true,
      },
    });

    vnpayPaymentWindow.on('closed', () => {
      if (vnpayPaymentParent && !vnpayPaymentParent.isDestroyed()) {
        vnpayPaymentParent.send('vnpay:payment-window-closed');
      }
      closeVNPayPaymentWindow();
    });

    vnpayPaymentWindow.webContents.on('will-redirect', (event, url) => {
      if (handleVNPayReturnUrl(url)) {
        event.preventDefault();
      }
    });

    vnpayPaymentWindow.webContents.on('did-navigate', (_event, url) => {
      handleVNPayReturnUrl(url);
    });

    vnpayPaymentWindow.webContents.setWindowOpenHandler(({ url }) => {
      if (url) {
        shell.openExternal(url);
      }
      return { action: 'deny' };
    });

    vnpayPaymentWindow.webContents.on('did-fail-load', (event, errorCode, errorDescription, validatedURL) => {
      if (errorCode === -105 && vnpayReturnUrl && validatedURL && validatedURL.startsWith(vnpayReturnUrl)) {
        // Host unreachable for return URL, but we already handled it in will-redirect
        return;
      }
      console.error('VNPay window failed to load:', errorCode, errorDescription, validatedURL);
    });

    vnpayPaymentWindow.loadURL(paymentUrl);
    vnpayPaymentWindow.once('ready-to-show', () => {
      if (vnpayPaymentWindow) {
        vnpayPaymentWindow.show();
        vnpayPaymentWindow.focus();
      }
    });

    return { success: true };
  } catch (error) {
    console.error('Error opening VNPay payment window:', error);
    if (sender && !sender.isDestroyed()) {
      sender.send('vnpay:payment-result', {
        source: 'vnpay-window',
        error: error.message,
      });
    }
    closeVNPayPaymentWindow();
    return { success: false, error: error.message };
  }
};

function createWindow() {
  mainWindow = new BrowserWindow({
    width: 1400,
    height: 900,
    minWidth: 1200,
    minHeight: 700,
    webPreferences: {
      nodeIntegration: false,
      contextIsolation: true,
      enableRemoteModule: false,
      preload: path.join(__dirname, 'preload.js'),
      webviewTag: true
    },
    icon: path.join(__dirname, 'assets/icon.png'),
    show: false,
    titleBarStyle: 'hidden',
    autoHideMenuBar: true,
    fullscreen: false,
    maximizable: true,
    frame: false
  });

  const loadURL = isDev
    ? 'http://localhost:3000'
    : `file://${path.join(__dirname, '../build/index.html')}`;
  
  // Always log for debugging
  console.log('=== Electron Debug Info ===');
  console.log('isDev:', isDev);
  console.log('ELECTRON_IS_DEV env:', process.env.ELECTRON_IS_DEV);
  console.log('NODE_ENV:', process.env.NODE_ENV);
  console.log('Loading URL:', loadURL);
  console.log('__dirname:', __dirname);
  console.log('Build path:', path.join(__dirname, '../build/index.html'));
  console.log('==========================');

  mainWindow.loadURL(loadURL);

  mainWindow.once('ready-to-show', () => {
    mainWindow.maximize();
    mainWindow.show();
  if (isDev) console.log('Window shown successfully');
    
    if (isDev) {
      mainWindow.webContents.openDevTools();
    }
  });

  mainWindow.webContents.on('did-fail-load', (event, errorCode, errorDescription, validatedURL) => {
  if (isDev) console.error('Failed to load:', errorCode, errorDescription, validatedURL);
  });

  mainWindow.webContents.on('dom-ready', () => {
  if (isDev) console.log('DOM ready');
  });

  mainWindow.webContents.on('did-finish-load', () => {
  if (isDev) console.log('Page finished loading');
  });

  mainWindow.webContents.on('console-message', (event, level, message, line, sourceId) => {
  if (isDev) console.log(`Console [${level}]: ${message}`);
  });

  mainWindow.on('closed', () => {
    mainWindow = null;
    if (ipcHandlers) {
      ipcHandlers.removeAllHandlers();
      ipcHandlers = null;
    }
  });

  // Clear session data when window is closing
  mainWindow.on('close', (event) => {
    // Clear localStorage session data (not remembered credentials)
    mainWindow.webContents.executeJavaScript(`
      localStorage.removeItem('pmbh_user');
      localStorage.removeItem('pmbh_token');
    `).catch(() => {
      // Ignore errors if webContents is already destroyed
    });
  });

  // Tạo menu
  const template = [
    {
      label: 'Tệp',
      submenu: [
        {
          label: 'Đăng xuất',
          accelerator: 'CmdOrCtrl+Q',
          click: () => {
            app.quit();
          }
        }
      ]
    },
    {
      label: 'Chỉnh sửa',
      submenu: [
        { role: 'undo', label: 'Hoàn tác' },
        { role: 'redo', label: 'Làm lại' },
        { type: 'separator' },
        { role: 'cut', label: 'Cắt' },
        { role: 'copy', label: 'Sao chép' },
        { role: 'paste', label: 'Dán' }
      ]
    },
    {
      label: 'Xem',
      submenu: [
        { role: 'reload', label: 'Tải lại' },
        { role: 'forceReload', label: 'Buộc tải lại' },
        { role: 'toggleDevTools', label: 'Công cụ phát triển' },
        { type: 'separator' },
        { role: 'resetZoom', label: 'Đặt lại zoom' },
        { role: 'zoomIn', label: 'Phóng to' },
        { role: 'zoomOut', label: 'Thu nhỏ' },
        { type: 'separator' },
        { role: 'togglefullscreen', label: 'Toàn màn hình' }
      ]
    }
  ];

  const menu = Menu.buildFromTemplate(template);
  Menu.setApplicationMenu(menu);
}

// Create customer display window
function createCustomerDisplayWindow() {
  if (customerDisplayWindow) {
    customerDisplayWindow.focus();
    return { success: true, message: 'Window already exists' };
  }

  customerDisplayWindow = new BrowserWindow({
    width: 1024,
    height: 768,
    minWidth: 800,
    minHeight: 600,
    webPreferences: {
      nodeIntegration: false,
      contextIsolation: true,
      enableRemoteModule: false,
      preload: path.join(__dirname, 'preload.js')
    },
    title: 'Customer Display - POS CAFE',
    show: false,
    autoHideMenuBar: true,
    backgroundColor: '#f5f7fa'
  });

  const displayURL = isDev
    ? 'http://localhost:3000/#/customer-display'
    : `file://${path.join(__dirname, '../build/index.html')}#/customer-display`;

  customerDisplayWindow.loadURL(displayURL);

  customerDisplayWindow.once('ready-to-show', () => {
    customerDisplayWindow.show();
    if (isDev) console.log('Customer display window shown');
  });

  customerDisplayWindow.on('closed', () => {
    customerDisplayWindow = null;
    // Notify main window that customer display is closed
    if (mainWindow && !mainWindow.isDestroyed()) {
      mainWindow.webContents.send('customer-display-closed');
    }
  });

  return { success: true, message: 'Customer display window created' };
}

// Close customer display window
function closeCustomerDisplayWindow() {
  if (customerDisplayWindow && !customerDisplayWindow.isDestroyed()) {
    customerDisplayWindow.close();
    customerDisplayWindow = null;
    return { success: true, message: 'Customer display closed' };
  }
  return { success: false, message: 'No customer display window to close' };
}

// Send data to customer display
function sendToCustomerDisplay(data) {
  if (customerDisplayWindow && !customerDisplayWindow.isDestroyed()) {
    customerDisplayWindow.webContents.send('customer-display-update', data);
    return { success: true };
  }
  return { success: false, message: 'Customer display not available' };
}

app.whenReady().then(() => {
  createWindow();
  
  // Initialize IPC handlers
  ipcHandlers = new IPCHandlers();
});

app.on('window-all-closed', () => {
  if (process.platform !== 'darwin') {
    app.quit();
  }
});

app.on('activate', () => {
  if (BrowserWindow.getAllWindows().length === 0) {
    createWindow();
  }
});

// Window control IPC handlers
ipcMain.handle('window-minimize', () => {
  if (mainWindow) {
    mainWindow.minimize();
  }
});

ipcMain.handle('window-maximize', () => {
  if (mainWindow) {
    if (mainWindow.isMaximized()) {
      mainWindow.restore();
    } else {
      mainWindow.maximize();
    }
  }
});

ipcMain.handle('window-close', () => {
  if (mainWindow) {
    mainWindow.close();
  }
});

ipcMain.handle('app-quit', () => {
  app.quit();
});

// IPC handlers
ipcMain.handle('show-message-box', async (event, options) => {
  const result = await dialog.showMessageBox(mainWindow, options);
  return result;
});

ipcMain.handle('show-save-dialog', async (event, options) => {
  const result = await dialog.showSaveDialog(mainWindow, options);
  return result;
});

ipcMain.handle('show-open-dialog', async (event, options) => {
  const result = await dialog.showOpenDialog(mainWindow, options);
  return result;
});

// Customer Display IPC handlers
ipcMain.handle('open-customer-display', async () => {
  return createCustomerDisplayWindow();
});

ipcMain.handle('close-customer-display', async () => {
  return closeCustomerDisplayWindow();
});

ipcMain.handle('send-to-customer-display', async (event, data) => {
  return sendToCustomerDisplay(data);
});

ipcMain.handle('request-customer-display-data', async () => {
  // Request main window to send current cart data
  if (mainWindow && !mainWindow.isDestroyed()) {
    mainWindow.webContents.send('request-cart-data-for-display');
  }
  return { success: true };
});

ipcMain.handle('vnpay:open-payment-window', (event, payload) => {
  return openVNPayPaymentWindow(payload, event.sender);
});

ipcMain.handle('vnpay:close-payment-window', () => {
  closeVNPayPaymentWindow();
  return { success: true };
});

