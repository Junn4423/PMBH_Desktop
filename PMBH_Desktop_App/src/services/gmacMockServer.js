// Mock GMAC Server Response cho testing
// Chỉ sử dụng khi GMAC server thực tế không khả dụng

export const mockGmacLogin = async (username, password) => {
  // Simulate network delay
  await new Promise(resolve => setTimeout(resolve, 500));

  // Mock successful login response từ GMAC
  if (username === 'admin' && password === '123456') {
    return {
      success: true,
      token: `gmac_token_${Date.now()}`,
      userCode: 'ADMIN001',
      userId: 1,
      message: 'Đăng nhập thành công',
      expires: Date.now() + (60 * 60 * 1000) // 1 hour
    };
  } else {
    throw new Error('Tên đăng nhập hoặc mật khẩu không chính xác');
  }
};

export const mockGmacApi = async (endpoint, data) => {
  // Simulate network delay
  await new Promise(resolve => setTimeout(resolve, 300));

  // Mock API responses based on endpoint
  switch (endpoint) {
    case 'Mb_loaiSanPham':
      return {
        success: true,
        data: [
          { id: 1, ten: 'Cà phê', moTa: 'Các loại cà phê' },
          { id: 2, ten: 'Trà', moTa: 'Các loại trà' },
          { id: 3, ten: 'Nước ép', moTa: 'Nước ép tươi' },
          { id: 4, ten: 'Bánh ngọt', moTa: 'Bánh và tráng miệng' }
        ]
      };

    case 'Mb_sanPham':
      return {
        success: true,
        data: [
          { id: 1, ten: 'Cà phê đen', gia: 15000, loaiId: 1 },
          { id: 2, ten: 'Cà phê sữa', gia: 18000, loaiId: 1 },
          { id: 3, ten: 'Cappuccino', gia: 25000, loaiId: 1 },
          { id: 4, ten: 'Trà đen', gia: 12000, loaiId: 2 },
          { id: 5, ten: 'Trà sữa', gia: 22000, loaiId: 2 }
        ]
      };

    default:
      return {
        success: true,
        data: [],
        message: `Mock response for ${endpoint}`
      };
  }
};
