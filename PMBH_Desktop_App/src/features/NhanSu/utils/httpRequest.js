import axios, {AxiosResponse} from 'axios';

const httpRequest = axios.create({
  baseURL: 'http://192.168.1.101/gmac/services.sof.vn/index.php',
});

httpRequest.interceptors.response.use(
  function (response: AxiosResponse) {
    return response.data || {statusCode: response.status};
  },
  function (error) {
    return Promise.reject(error);
  },
);

export default httpRequest;
