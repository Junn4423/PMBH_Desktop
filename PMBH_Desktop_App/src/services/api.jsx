import axios from 'axios';
import { STORAGE_KEYS, API_ENDPOINTS, REQUEST_TIMEOUT } from '../constants';

// Tạo axios instance
const api = axios.create({
  baseURL: process.env.REACT_APP_API_URL || 'http://localhost:3001/api',
  timeout: REQUEST_TIMEOUT,
  headers: {
    'Content-Type': 'application/json',
  },
});

// Request interceptor - thêm token vào header
api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem(STORAGE_KEYS.TOKEN);
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

// Response interceptor - xử lý lỗi và refresh token
api.interceptors.response.use(
  (response) => {
    return response.data;
  },
  async (error) => {
    const originalRequest = error.config;

    if (error.response?.status === 401 && !originalRequest._retry) {
      originalRequest._retry = true;

      try {
        const refreshToken = localStorage.getItem(STORAGE_KEYS.REFRESH_TOKEN);
        if (refreshToken) {
          const response = await axios.post(
            `${api.defaults.baseURL}${API_ENDPOINTS.AUTH.REFRESH}`,
            { refreshToken }
          );

          const { token } = response.data;
          localStorage.setItem(STORAGE_KEYS.TOKEN, token);

          return api(originalRequest);
        }
      } catch (refreshError) {
        // Refresh token hết hạn, đăng xuất user
        localStorage.removeItem(STORAGE_KEYS.TOKEN);
        localStorage.removeItem(STORAGE_KEYS.REFRESH_TOKEN);
        localStorage.removeItem(STORAGE_KEYS.USER);
        window.location.href = '/login';
      }
    }

    return Promise.reject(error);
  }
);

// Auth API
export const authAPI = {
  login: (credentials) => api.post(API_ENDPOINTS.AUTH.LOGIN, credentials),
  logout: () => api.post(API_ENDPOINTS.AUTH.LOGOUT),
  refreshToken: (refreshToken) => api.post(API_ENDPOINTS.AUTH.REFRESH, { refreshToken }),
  getProfile: () => api.get(API_ENDPOINTS.AUTH.PROFILE),
};

// Products API
export const productsAPI = {
  getAll: (params) => api.get(API_ENDPOINTS.PRODUCTS.LIST, { params }),
  getById: (id) => api.get(`${API_ENDPOINTS.PRODUCTS.LIST}/${id}`),
  create: (data) => api.post(API_ENDPOINTS.PRODUCTS.CREATE, data),
  update: (id, data) => api.put(`${API_ENDPOINTS.PRODUCTS.UPDATE}/${id}`, data),
  delete: (id) => api.delete(`${API_ENDPOINTS.PRODUCTS.DELETE}/${id}`),
  getCategories: () => api.get(API_ENDPOINTS.PRODUCTS.CATEGORIES),
};

// Tables API
export const tablesAPI = {
  getAll: (params) => api.get(API_ENDPOINTS.TABLES.LIST, { params }),
  getById: (id) => api.get(`${API_ENDPOINTS.TABLES.LIST}/${id}`),
  create: (data) => api.post(API_ENDPOINTS.TABLES.CREATE, data),
  update: (id, data) => api.put(`${API_ENDPOINTS.TABLES.UPDATE}/${id}`, data),
  delete: (id) => api.delete(`${API_ENDPOINTS.TABLES.DELETE}/${id}`),
  updateStatus: (id, status) => api.patch(`${API_ENDPOINTS.TABLES.STATUS}/${id}`, { status }),
};

// Orders API
export const ordersAPI = {
  getAll: (params) => api.get(API_ENDPOINTS.ORDERS.LIST, { params }),
  getById: (id) => api.get(`${API_ENDPOINTS.ORDERS.DETAIL}/${id}`),
  create: (data) => api.post(API_ENDPOINTS.ORDERS.CREATE, data),
  update: (id, data) => api.put(`${API_ENDPOINTS.ORDERS.UPDATE}/${id}`, data),
  delete: (id) => api.delete(`${API_ENDPOINTS.ORDERS.DELETE}/${id}`),
  updateStatus: (id, status) => api.patch(`${API_ENDPOINTS.ORDERS.UPDATE}/${id}/status`, { status }),
};

// Customers API
export const customersAPI = {
  getAll: (params) => api.get(API_ENDPOINTS.CUSTOMERS.LIST, { params }),
  getById: (id) => api.get(`${API_ENDPOINTS.CUSTOMERS.LIST}/${id}`),
  create: (data) => api.post(API_ENDPOINTS.CUSTOMERS.CREATE, data),
  update: (id, data) => api.put(`${API_ENDPOINTS.CUSTOMERS.UPDATE}/${id}`, data),
  delete: (id) => api.delete(`${API_ENDPOINTS.CUSTOMERS.DELETE}/${id}`),
};

// Employees API
export const employeesAPI = {
  getAll: (params) => api.get(API_ENDPOINTS.EMPLOYEES.LIST, { params }),
  getById: (id) => api.get(`${API_ENDPOINTS.EMPLOYEES.LIST}/${id}`),
  create: (data) => api.post(API_ENDPOINTS.EMPLOYEES.CREATE, data),
  update: (id, data) => api.put(`${API_ENDPOINTS.EMPLOYEES.UPDATE}/${id}`, data),
  delete: (id) => api.delete(`${API_ENDPOINTS.EMPLOYEES.DELETE}/${id}`),
};

// Reports API
export const reportsAPI = {
  getRevenue: (params) => api.get(API_ENDPOINTS.REPORTS.REVENUE, { params }),
  getSales: (params) => api.get(API_ENDPOINTS.REPORTS.SALES, { params }),
  getProducts: (params) => api.get(API_ENDPOINTS.REPORTS.PRODUCTS, { params }),
  getCustomers: (params) => api.get(API_ENDPOINTS.REPORTS.CUSTOMERS, { params }),
};

// Upload API
export const uploadAPI = {
  uploadImage: (file) => {
    const formData = new FormData();
    formData.append('image', file);
    return api.post('/upload/image', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });
  },
  
  uploadMultiple: (files) => {
    const formData = new FormData();
    files.forEach((file, index) => {
      formData.append(`images[${index}]`, file);
    });
    return api.post('/upload/multiple', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });
  },
};

// Export default API instance
export default api;
