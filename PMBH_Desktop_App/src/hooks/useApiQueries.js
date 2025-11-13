import { useQuery, useQueryClient } from '@tanstack/react-query';
import { getAllProducts, getProductCategories } from '../../services/domains/catalogService';
import {
  loadBan,
  loadKhuVuc,
  loadDsHoaDon,
  getChiTietHoaDonTheoMaHD
} from '../../services/apiServices';

// Query keys
export const QUERY_KEYS = {
  TABLES: ['tables'],
  AREAS: ['areas'],
  PRODUCTS: ['products'],
  PRODUCT_CATEGORIES: ['productCategories'],
  INVOICES: ['invoices'],
  INVOICE_DETAILS: (invoiceId) => ['invoiceDetails', invoiceId],
};

// Tables
export function useTables() {
  return useQuery({
    queryKey: QUERY_KEYS.TABLES,
    queryFn: loadBan,
    staleTime: 2 * 60 * 1000, // 2 minutes
  });
}

// Areas
export function useAreas() {
  return useQuery({
    queryKey: QUERY_KEYS.AREAS,
    queryFn: loadKhuVuc,
    staleTime: 5 * 60 * 1000, // 5 minutes
  });
}

// Products - lazy loaded
export function useProducts() {
  return useQuery({
    queryKey: QUERY_KEYS.PRODUCTS,
  queryFn: getAllProducts,
    staleTime: 5 * 60 * 1000,
    enabled: false, // Only load when explicitly enabled
  });
}

// Product categories
export function useProductCategories() {
  return useQuery({
    queryKey: QUERY_KEYS.PRODUCT_CATEGORIES,
  queryFn: getProductCategories,
    staleTime: 10 * 60 * 1000, // 10 minutes
  });
}

// Invoices
export function useInvoices() {
  return useQuery({
    queryKey: QUERY_KEYS.INVOICES,
    queryFn: loadDsHoaDon,
    staleTime: 1 * 60 * 1000, // 1 minute
  });
}

// Invoice details
export function useInvoiceDetails(invoiceId) {
  return useQuery({
    queryKey: QUERY_KEYS.INVOICE_DETAILS(invoiceId),
    queryFn: () => getChiTietHoaDonTheoMaHD(invoiceId),
    enabled: !!invoiceId,
    staleTime: 2 * 60 * 1000,
  });
}

// Mutations for updating data
export function useInvalidateTables() {
  const queryClient = useQueryClient();

  return () => {
    queryClient.invalidateQueries({ queryKey: QUERY_KEYS.TABLES });
  };
}

export function useInvalidateInvoices() {
  const queryClient = useQueryClient();

  return () => {
    queryClient.invalidateQueries({ queryKey: QUERY_KEYS.INVOICES });
  };
}