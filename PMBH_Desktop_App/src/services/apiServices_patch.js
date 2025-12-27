// PATCH FOR testServiceConnection function
// Replace lines 122-149 in apiServices.js

export async function testServiceConnection() {
  try {
    const urlApi = getUrlApi();
    const headers = await getAuthHeaders();
    
    // Use a real lightweight query that should exist in any database
    const payload = {
      table: 'Mb_loaiSanPham',
      func: 'data'
    };

    const response = await axios.post(urlApi, payload, { 
      headers,
      timeout: 8000 // 8 second timeout
    });

    // If we get any successful response, service is reachable
    if (response.status === 200) {
      // Even if data is empty or null, connection is OK
      return { success: true };
    }
    
    return { 
      success: false, 
      message: 'Dịch vụ không phản hồi đúng cách' 
    };
  } catch (error) {
    console.error('Service connection test failed:', error);
    
    // 404 means endpoint/database not found
    if (error.response?.status === 404) {
      return { 
        success: false, 
        message: 'Máy chủ dịch vụ không tìm thấy. Tài khoản có thể không được cấu hình cho dịch vụ này.' 
      };
    }
    
    // Network/connection errors
    if (error.code === 'ECONNREFUSED' || error.code === 'ENOTFOUND' || error.code === 'ETIMEDOUT') {
      return { 
        success: false, 
        message: 'Không thể kết nối đến máy chủ dịch vụ. Vui lòng kiểm tra kết nối mạng.' 
      };
    }
    
    // Database not found or service errors
    if (error.response?.status === 500) {
      return { 
        success: false, 
        message: 'Máy chủ dịch vụ không khả dụng hoặc database không tồn tại.' 
      };
    }
    
    // Timeout
    if (error.code === 'ECONNABORTED') {
      return { 
        success: false, 
        message: 'Kết nối đến máy chủ dịch vụ bị timeout.' 
      };
    }
    
    // Generic error
    return { 
      success: false, 
      message: error.message || 'Không thể kết nối đến máy chủ dịch vụ' 
    };
  }
}
