import React, { useState, useEffect, memo } from 'react';
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
  extraActions = null, // Actions to display below product info
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

  // Lazy load product image only when needed
  useEffect(() => {
    // Skip loading database image initially - load only on hover or when visible
    if (product?.hinhAnh && isValidImage(product.hinhAnh)) {
      const fullUrl = getFullImageUrl(product.hinhAnh);
      setProductImageUrl(fullUrl);
      setImageLoading(false);
    } else {
      setImageLoading(false);
    }
  }, [product?.id, product?.hinhAnh]);

  const loadProductImageFromDB = async () => {
    if (!product?.id || productImageUrl) {
      return; // Skip if already loaded
    }

    try {
      setImageLoading(true);
      const imageData = await loadProductImage(product.id);
      if (imageData && imageData.imagePath) {
        const fullUrl = getFullImageUrl(imageData.imagePath);
        setProductImageUrl(fullUrl);
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
      onMouseEnter={loadProductImageFromDB} // Lazy load on hover
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
        
        {/* Extra Actions */}
        {extraActions && (
          <div className="product-extra-actions" style={{ marginTop: '8px', display: 'flex', gap: '8px', justifyContent: 'center' }}>
            {extraActions}
          </div>
        )}
      </div>
    </div>
  );
};

export default memo(ProductCard, (prevProps, nextProps) => {
  // Only re-render if essential props change
  return (
    prevProps.product?.id === nextProps.product?.id &&
    prevProps.product?.ten === nextProps.product?.ten &&
    prevProps.product?.gia === nextProps.product?.gia &&
    prevProps.product?.hinhAnh === nextProps.product?.hinhAnh &&
    prevProps.loading === nextProps.loading &&
    prevProps.selected === nextProps.selected &&
    prevProps.extraActions === nextProps.extraActions
  );
});