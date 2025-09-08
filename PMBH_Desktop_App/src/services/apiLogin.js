import axios from 'axios';
import {url_api_services, url_login_api, url_api_logout, environment} from "./url";

const urlApi = url_api_services;
const urlLoginApi = url_login_api;
const urlLogoutApi = url_api_logout;

// Debug environment
console.log('API Login Environment:', environment);

// -------------------- Authentication helpers --------------------
let authCache = null; // Lưu token sau lần đăng nhập đầu tiên

async function getAuthToken(
  username = "",
  password = "",
  forceRefresh = false
) {
  // Use cached token if available and not forcing refresh
  if (authCache && !forceRefresh) {
    console.log("Using cached auth token");
    return authCache;
  }

  console.log("Getting fresh auth token...");
  console.log("Login URL:", urlLoginApi);

  const payload = {
    txtUserName: username,
    txtPassword: password,
  };

  try {
    const res = await axios.post(urlLoginApi, payload, {
      headers: { "Content-Type": "application/json" },
    });

    const result = res.data;

    // Kiểm tra nếu có lỗi trong response
    if (result.error) {
      console.error("Login error:", result.error);
      throw new Error(result.error);
    }

    // Kiểm tra nếu không có token
    if (!result.token || !result.code) {
      console.error("Invalid login response:", result);
      throw new Error("Đăng nhập thất bại: không nhận được token");
    }

    authCache = result;
    console.log("Got auth token:", authCache);
    return authCache;
  } catch (error) {
    console.error("Login failed:", error.response ? error.response.data : error.message);
    throw new Error("Không thể đăng nhập để lấy token");
  }
}

export async function getAuthHeaders(forceRefresh = false) {
  const authData = await getAuthToken("admin", "1", forceRefresh);
  return {
    "Content-Type": "application/json",
    "X-USER-CODE": authData.code,
    "X-USER-TOKEN": authData.token,
  };
}

async function callApiWithAuth(payload, retryCount = 0) {
  console.log("Calling API with auth:", payload, "retry count:", retryCount);

  try {
    const headers = await getAuthHeaders(retryCount > 0); // Force refresh on retry
    console.log("Using headers:", headers);

    const res = await axios.post(urlApi, payload, { headers });

    const result = res.data;
    console.log("API response:", result);
    return result;
  } catch (error) {
    // If we get 401 and haven't retried yet, clear cache and retry
    if (error.response && error.response.status === 401 && retryCount === 0) {
      console.log("Got 401, clearing auth cache and retrying...");
      authCache = null; // Clear cached token
      return callApiWithAuth(payload, 1); // Retry once
    }
    throw error;
  }
}

export async function login(username, password) {
  try {
    console.log("Login attempt:", { username, loginUrl: urlLoginApi });
    
    const payload = {
      txtUserName: username,
      txtPassword: password,
    };

    const res = await axios.post(urlLoginApi, payload, {
      headers: { "Content-Type": "application/json" },
    });

    console.log("Login response:", res.data);
    const result = res.data;

    if (result.code && result.token) {
      authCache = result;
      console.log("Login successful:", result);
      return result;
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