import axios from 'axios';
import { url_api_services as urlApi } from '../url';
import { getAuthHeaders, refreshAuthToken } from '../apiLogin';

export const isInvalidAuthResponse = (data) => {
  if (data === null || data === undefined) {
    return false;
  }

  if (typeof data === 'string') {
    const normalized = data.toLowerCase();
    return normalized === 'invalid' || normalized.includes('invalid token');
  }

  const message = data.message || data.error || data.statusMessage;
  if (!message) {
    return false;
  }

  const normalizedMessage = String(message).toLowerCase();
  return normalizedMessage === 'invalid' || normalizedMessage.includes('invalid token');
};

export async function callApi(table, func, additionalData = {}, retryCount = 0) {
  try {
    const headers = await getAuthHeaders(retryCount > 0);
    const payload = {
      table,
      func,
      ...additionalData,
    };

    const response = await axios.post(urlApi, payload, { headers });
    const data = response.data;

    if (isInvalidAuthResponse(data)) {
      if (retryCount === 0) {
        try {
          await refreshAuthToken();
        } catch (error) {
          console.error('Failed to refresh token after invalid response:', error);
          throw error;
        }
        return callApi(table, func, additionalData, 1);
      }

      console.warn(`API returned invalid auth response after retry for ${table}.${func}`);
      return [];
    }

    if (data === null || data === undefined) {
      console.warn(`API returned null/undefined for ${table}.${func}`);
      return [];
    }

    return data;
  } catch (error) {
    if ((error.response?.status === 401 || error.message?.includes('token')) && retryCount === 0) {
      return callApi(table, func, additionalData, 1);
    }

    console.error(`API call failed for table: ${table}, func: ${func}`, error);
    throw error;
  }
}

export default callApi;
