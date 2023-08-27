import axios, { AxiosResponse } from 'axios';

const apiMixin = {
  methods: {
    async $httpGet<T>(url: string, params?: any): Promise<AxiosResponse<T>> {
      try {
        const response: AxiosResponse<T> = await axios.get(url, { params });
        return response;
      } catch (error) {
        throw error;
      }
    },

    async $httpPost<T>(url: string, data?: any): Promise<AxiosResponse<T>> {
      try {
        const response: AxiosResponse<T> = await axios.post(url, data);
        return response;
      } catch (error) {
        throw error;
      }
    },

    async $httpPatch<T>(url: string, data?: any): Promise<AxiosResponse<T>> {
      try {
        const response: AxiosResponse<T> = await axios.patch(url, data);
        return response;
      } catch (error) {
        throw error;
      }
    },

    async $httpDelete<T>(url: string): Promise<AxiosResponse<T>> {
      try {
        const response: AxiosResponse<T> = await axios.delete(url);
        return response;
      } catch (error) {
        throw error;
      }
    }
  },
}

export default apiMixin
