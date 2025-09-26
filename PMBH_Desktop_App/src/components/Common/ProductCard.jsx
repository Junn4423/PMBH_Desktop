import React, { useState, useEffect } from 'react';
import { Typography } from 'antd';
import cafeImg from '../../assets/Img/cafe.png';
import { loadProductImage, getFullImageUrl } from '../../services/apiServices';
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
  size = 'default', // 'small', 'default', 'large'
  ...props 
}) => {
  const [imageError, setImageError] = useState(false);
  const [imageLoading, setImageLoading] = useState(true);
  const [productImageUrl, setProductImageUrl] = useState(null);
  const [imageDimensions, setImageDimensions] = useState({ width: 0, height: 0 });

  // Responsive image sizes based on screen size and props
  const getImageSize = () => {
    switch (size) {
      case 'small':
        return { width: 80, height: 80, placeholder: 60 };
      case 'large':
        return { width: 150, height: 150, placeholder: 130 };
      default:
        return { width: 120, height: 120, placeholder: 100 };
    }
  };

  const imageSize = getImageSize();

  // Load product image from database on component mount
  useEffect(() => {
    loadProductImageFromDB();
  }, [product?.id]);

  const loadProductImageFromDB = async () => {
    if (!product?.id) {
      setImageLoading(false);
      return;
    }

    try {
      setImageLoading(true);
      
      // First check if product already has a valid image URL
      if (isValidImage(product.hinhAnh)) {
        const fullUrl = getFullImageUrl(product.hinhAnh);
        setProductImageUrl(fullUrl);
      } else {
        // Try to load image from database
        const imageData = await loadProductImage(product.id);
        if (imageData && imageData.imagePath) {
          const fullUrl = getFullImageUrl(imageData.imagePath);
          setProductImageUrl(fullUrl);
        }
      }
    } catch (error) {
      console.error('Error loading product image:', error);
      setImageError(true);
    } finally {
      setImageLoading(false);
    }
  };

  const handleImageError = () => {
    setImageError(true);
    setImageLoading(false);
  };

  const handleImageLoad = (event) => {
    const img = event.target;
    setImageDimensions({ width: img.naturalWidth, height: img.naturalHeight });
    setImageLoading(false);
    setImageError(false);
    // Bỏ validation để chấp nhận mọi kích thước ảnh
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
    size ? `size-${size}` : '',
    className
  ].filter(Boolean).join(' ');

  const shouldShowPlaceholder = !productImageUrl || imageError;

  return (
    <div 
      className={cardClasses}
      onClick={handleCardClick}
      style={{ cursor: loading ? 'default' : 'pointer' }}
      {...props}
    >
      {/* Product Image - Responsive sizing */}
      <div className="product-image-wrapper">
        {shouldShowPlaceholder ? (
          <div className="product-image-placeholder">
            <img 
              src={cafeImg} 
              alt="Cafe placeholder"
            />
          </div>
        ) : (
          <>
            <img
              src={productImageUrl}
              alt={product.ten || 'Product'}
              className="product-image"
              onError={handleImageError}
              onLoad={handleImageLoad}
              style={{ 
                display: imageLoading ? 'none' : 'block'
              }}
            />
            
            {/* Fallback khi ảnh thật load lỗi */}
            {imageError && (
              <div className="product-image-placeholder">
                <img 
                  src={cafeImg} 
                  alt="Fallback placeholder"
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
              style={{ opacity: 0.5 }}
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

      {/* Product Info - Enhanced display */}
      <div className="product-info">
        <Typography.Text className="product-name" title={product.ten || 'Không có tên'}>
          {product.ten || 'Không có tên'}
        </Typography.Text>
        <Typography.Text className="product-price">
          {typeof product.gia === 'number' && product.gia > 0
            ? `${product.gia.toLocaleString('vi-VN')}đ` 
            : '0đ'
          }
        </Typography.Text>
        
        {/* Description (optional) */}
        {product.moTa && (
          <Typography.Text className="product-description" type="secondary">
            {product.moTa}
          </Typography.Text>
        )}
      </div>
    </div>
  );
};

export default ProductCard;