import axios, { AxiosResponse } from 'axios';

const httpRequestAPICCCD = axios.create({
  baseURL: 'http://192.168.1.10:5000/api/process-id',
});

httpRequestAPICCCD.interceptors.response.use(
  function (response: AxiosResponse) {
    return response.data || { statusCode: response.status };
  },
  function (error) {
    return Promise.reject(error);
  },
);

export default httpRequestAPICCCD;
