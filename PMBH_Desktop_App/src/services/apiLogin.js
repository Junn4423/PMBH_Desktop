import axios from 'axios';
import {url_api_services, url_login_api, url_api_logout, environment} from "./url";

const urlApi = url_api_services;
const urlLoginApi = url_login_api;
const urlLogoutApi = url_api_logout;

// GMAC login endpoint
const GMAC_LOGIN_URL = 'http://192.168.1.19/gmac/login.sof.vn/index.php';

// Debug environment

// -------------------- Authentication helpers --------------------
let authCache = null; // Lưu token sau lần đăng nhập đầu tiên
let authExpiry = null; // Thời gian hết hạn token

async function getAuthToken(forceRefresh = false) {
  // Check if cached token is still valid
  if (authCache && authExpiry && Date.now() < authExpiry && !forceRefresh) {
    return authCache;
  }


  const payload = {
    txtUserName: "admin",
    txtPassword: "123456"
  };

  try {
    // Try real GMAC server first
    const res = await axios.post(GMAC_LOGIN_URL, payload, {
      headers: { 
        "Content-Type": "application/json",
        "Accept": "application/json"
      },
      timeout: 5000 // 5 second timeout
    });

    const result = res.data;

    if (result && result.token && result.code) {
      authCache = {
        token: result.token,
        code: result.code,
        userId: result.userId || 1,
        role: result.role,
        chiNhanh: result.chiNhanh
      };
      // Set expiry to 1 hour from now
      authExpiry = Date.now() + (60 * 60 * 1000);
      return authCache;
    } else {
      throw new Error("Invalid GMAC response");
    }
  } catch (error) {
    console.error("GMAC server not available:", error.message);
    authCache = null;
    authExpiry = null;
    throw new Error("Không thể kết nối đến server GMAC");
  }
}

export async function getAuthHeaders(forceRefresh = false) {
  try {
    const authData = await getAuthToken(forceRefresh);
    return {
      "Content-Type": "application/json",
      "Authorization": `Bearer ${authData.token}`,
      "X-USER-CODE": authData.code,
      "X-USER-TOKEN": authData.token,
    };
  } catch (error) {
    console.error("Failed to get auth headers:", error);
    // Return basic headers if auth fails
    return {
      "Content-Type": "application/json",
    };
  }
}

async function callApiWithAuth(payload, retryCount = 0) {

  try {
    const headers = await getAuthHeaders(retryCount > 0); // Force refresh on retry

    const res = await axios.post(urlApi, payload, { headers });

    const result = res.data;
    return result;
  } catch (error) {
    // If we get 401 and haven't retried yet, clear cache and retry
    if (error.response && error.response.status === 401 && retryCount === 0) {
      authCache = null; // Clear cached token
      authExpiry = null;
      return callApiWithAuth(payload, 1); // Retry once
    }
    throw error;
  }
}

export async function login(username, password) {
  try {
    
    const payload = {
      txtUserName: username,
      txtPassword: password,
    };

    const res = await axios.post(GMAC_LOGIN_URL, payload, {
      headers: { 
        "Content-Type": "application/json",
        "Accept": "application/json"
      },
    });

    const result = res.data;

    // Check if we have token and code (GMAC format)
    if (result.token && result.code) {
      authCache = {
        token: result.token,
        code: result.code,
        userId: result.userId || 1
      };
      authExpiry = Date.now() + (60 * 60 * 1000); // 1 hour
      return { 
        success: true, 
        token: result.token, 
        userCode: result.code,
        role: result.role,
        chiNhanh: result.chiNhanh 
      };
    } else {
      console.error("Login failed - invalid response:", result);
      throw new Error(result.message || "Đăng nhập thất bại");
    }
  } catch (error) {
    console.error("Login error:", error.response ? error.response.data : error.message);
    if (error.response) {
      console.error("Response status:", error.response.status);
      console.error("Response headers:", error.response.headers);
    }
    throw new Error("Đăng nhập thất bại");
  }
}
