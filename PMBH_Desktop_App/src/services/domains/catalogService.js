import axios from 'axios';
import { callApi } from '../api/baseApi';
import { getAuthHeaders } from '../apiLogin';
import { url_api_services, url_image_base } from '../url';

const normalizeCategoryPayload = (payload = {}) => {
  const {
    id,
    code,
    name,
    description,
    note,
    parentId,
    status,
    lv001,
    lv002,
    lv003,
    lv004,
    lv005,
  } = payload;

  return {
    lv001: lv001 ?? code ?? id ?? '',
    lv002: lv002 ?? name ?? '',
    lv003: lv003 ?? description ?? '',
    lv004: lv004 ?? note ?? '',
    lv005: lv005 ?? status ?? parentId ?? '',
  };
};

const normalizeProductPayload = (payload = {}) => {
  const {
    id,
    code,
    name,
    description,
    categoryId,
    price,
    unit,
    status,
    imageUrl,
    ...rest
  } = payload;

  return {
    lv001: rest.lv001 ?? code ?? id ?? '',
    lv002: rest.lv002 ?? name ?? '',
    lv003: rest.lv003 ?? description ?? '',
    lv004: rest.lv004 ?? categoryId ?? '',
    lv005: rest.lv005 ?? price ?? '',
    lv006: rest.lv006 ?? unit ?? '',
    lv007: rest.lv007 ?? status ?? '',
    lv008: rest.lv008 ?? imageUrl ?? '',
    ...rest,
  };
};

export const getProductCategories = () => callApi('Mb_loaiSanPham', 'data');

export const createProductCategory = (payload) =>
  callApi('Mb_loaiSanPham', 'add', normalizeCategoryPayload(payload));

export const updateProductCategory = (payload) =>
  callApi('Mb_loaiSanPham', 'edit', normalizeCategoryPayload(payload));

export const deleteProductCategory = (categoryId) =>
  callApi('Mb_loaiSanPham', 'delete', {
    lv001: categoryId,
  });

export const getProductsByCategory = (categoryId) =>
  callApi('Mb_sanPham', 'laySanTheoIdLoai', { findID: categoryId });

export const getAllProducts = () => callApi('Mb_sanPham', 'data');

export const updateProduct = (payload) => callApi('Mb_sanPham', 'edit', normalizeProductPayload(payload));

export const loadProductImage = async (productId) => {
  try {
    if (!productId) {
      return { success: false };
    }

    const baseUrl = url_api_services.split('/services.sof.vn/')[0];
    const getImageUrl = `${baseUrl}/services.sof.vn/get-image.php?id=${encodeURIComponent(productId)}`;

    const headers = await getAuthHeaders();
    const response = await axios.get(getImageUrl, { headers });

    if (response.data && response.data.status === 2002 && response.data.image) {
      return {
        success: true,
        imageUrl: `data:image/jpeg;base64,${response.data.image}`,
      };
    }

    return { success: false, data: response.data };
  } catch (error) {
    console.error('Error loading product image:', error);
    return { success: false, error: error.message };
  }
};

export const getFullImageUrl = (imagePath) => {
  if (!imagePath) {
    return null;
  }

  if (imagePath.startsWith('http://') || imagePath.startsWith('https://')) {
    return imagePath;
  }

  if (imagePath.startsWith('/')) {
    return `${url_image_base}${imagePath}`;
  }

  if (!imagePath.startsWith('images/')) {
    return `${url_image_base}/images/products/${imagePath}`;
  }

  return `${url_image_base}/${imagePath}`;
};

export const uploadProductImageFile = async (productId, imageFile) => {
  try {
    const formData = new FormData();
    formData.append('table', 'Mb_sanPham');
    formData.append('func', 'uploadImage');
    formData.append('maSp', productId);
    formData.append('imageFile', imageFile);

    const headers = await getAuthHeaders();
    const response = await axios.post(url_api_services, formData, {
      headers: {
        ...headers,
        'Content-Type': 'multipart/form-data',
      },
    });

    const success = response.data === true || response.data === 1 || response.data === '1';
    return { success, data: response.data };
  } catch (error) {
    console.error('Error uploading image:', error);
    return { success: false, error: error.message };
  }
};

export const updateProductImageUrl = async (productId, imageUrl) => {
  try {
    const result = await callApi('Mb_sanPham', 'updateImageUrl', {
      maSp: productId,
      imageUrl,
    });

    const success = result === true || result === 1 || result === '1';
    return { success, data: result };
  } catch (error) {
    console.error('Error updating product image URL:', error);
    return { success: false, error: error.message };
  }
};

export const uploadProductImageBlob = async (productId, imageFile) => {
  try {
    const formData = new FormData();
    formData.append('id', productId);
    formData.append('image', imageFile);

    const headers = await getAuthHeaders();
    const baseUrl = url_api_services.split('/services.sof.vn/')[0];
    const uploadUrl = `${baseUrl}/services.sof.vn/insert-image.php`;

    const response = await axios.post(uploadUrl, formData, {
      headers: {
        ...headers,
        'Content-Type': 'multipart/form-data',
      },
    });

    const success = response.data && response.data.status === 2002;
    return { success, data: response.data };
  } catch (error) {
    console.error('Error uploading image blob:', error);
    return { success: false, error: error.message };
  }
};

const catalogService = {
  getProductCategories,
  createProductCategory,
  updateProductCategory,
  deleteProductCategory,
  getProductsByCategory,
  getAllProducts,
  updateProduct,
  loadProductImage,
  getFullImageUrl,
  uploadProductImageFile,
  updateProductImageUrl,
  uploadProductImageBlob,
};

export default catalogService;
