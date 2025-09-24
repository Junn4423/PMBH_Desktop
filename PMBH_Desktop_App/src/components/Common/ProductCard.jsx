import React, { useState } from 'react';
import { Typography } from 'antd';
import cafeImg from '../../assets/Img/cafe.png';
import './ProductCard.css';

const { Text } = Typography;

const ProductCard = ({ 
  product, 
  onClick, 
  loading = false,
  selected = false,
  showBadge = false,
  badge = null,
  className = '',
  ...props 
}) => {
  const [imageError, setImageError] = useState(false);
  const [imageLoading, setImageLoading] = useState(true);

  const handleImageError = () => {
    setImageError(true);
    setImageLoading(false);
  };

  const handleImageLoad = () => {
    setImageLoading(false);
    setImageError(false);
  };

  const handleCardClick = () => {
    if (onClick && !loading) {
      onClick(product);
    }
  };

  // Kiểm tra ảnh có hợp lệ không
  const isValidImage = (url) => {
    if (!url) return false;
    if (typeof url !== 'string') return false;
    if (url.includes('default-product')) return false;
    if (url.includes('cafe.png')) return false;
    if (url === '../assets/Img/cafe.png') return false;
    if (url.trim() === '') return false;
    
    // Chỉ accept URL có extension hợp lệ
    const validExtensions = ['.jpg', '.jpeg', '.png', '.gif', '.webp', '.bmp'];
    const hasValidExtension = validExtensions.some(ext => 
      url.toLowerCase().includes(ext)
    );
    
    return hasValidExtension;
  };

  // Determine category class for styling
  const getCategoryClass = () => {
    const categoryMap = {
      'coffee': 'category-coffee',
      'ca-phe': 'category-coffee',
      'tea': 'category-tea',
      'tra': 'category-tea',
      'juice': 'category-juice',
      'nuoc-ep': 'category-juice',
      'cake': 'category-cake',
      'banh': 'category-cake',
      'snack': 'category-snack',
      'do-an-nhe': 'category-snack'
    };
    
    const category = product.danhMuc || product.category || '';
    return categoryMap[category.toLowerCase()] || 'category-other';
  };

  const cardClasses = [
    'product-card',
    getCategoryClass(),
    loading ? 'loading' : '',
    selected ? 'selected' : '',
    className
  ].filter(Boolean).join(' ');

  const shouldShowPlaceholder = !isValidImage(product.hinhAnh) || imageError;

  return (
    <div 
      className={cardClasses}
      onClick={handleCardClick}
      style={{ cursor: loading ? 'default' : 'pointer' }}
      {...props}
    >
      {/* Product Image */}
      <div className="product-image-wrapper">
        {shouldShowPlaceholder ? (
          <div className="product-image-placeholder">
            <img 
              src={cafeImg} 
              alt="Cafe placeholder" 
              style={{
                width: '60px',
                height: '60px',
                opacity: 1,
                filter: 'none',
                objectFit: 'contain'
              }}
            />
          </div>
        ) : (
          <>
            <img
              src={product.hinhAnh}
              alt={product.ten || 'Product'}
              className="product-image"
              onError={handleImageError}
              onLoad={handleImageLoad}
              style={{ 
                display: imageLoading ? 'none' : 'block',
                width: '100%',
                height: '100%',
                objectFit: 'cover'
              }}
            />
            {/* Fallback khi ảnh thật load lỗi */}
            {imageError && (
              <div className="product-image-placeholder">
                <img 
                  src={cafeImg} 
                  alt="Fallback placeholder" 
                  style={{
                    width: '60px',
                    height: '60px',
                    opacity: 1,
                    filter: 'none',
                    objectFit: 'contain'
                  }}
                />
              </div>
            )}
          </>
        )}
        
        {/* Loading state for image */}
           {imageLoading && !shouldShowPlaceholder && (
          <div className="product-image-placeholder">
            <img 
              src={cafeImg} 
              alt="Loading..." 
              style={{
                width: '60px',
                height: '60px',
                   opacity: 0.7,
                   filter: 'none',
                   objectFit: 'contain'
              }}
            />
          </div>
        )}

        {/* Badge */}
        {showBadge && badge && (
          <div className={`product-badge ${badge.type || ''}`}>
            {badge.text}
          </div>
        )}
      </div>

      {/* Product Info */}
      <div className="product-info">
        <Text className="product-name" title={product.ten}>
          {product.ten || 'Không có tên'}
        </Text>
        <Text className="product-price">
          {typeof product.gia === 'number' 
            ? product.gia.toLocaleString('vi-VN') 
            : '0'
          }đ
        </Text>
        
        {/* Description (optional) */}
        {product.moTa && (
          <Text className="product-description" type="secondary">
            {product.moTa}
          </Text>
        )}
      </div>
    </div>
  );
};

export default ProductCard;