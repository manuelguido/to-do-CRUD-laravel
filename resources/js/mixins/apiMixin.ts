import axios, { AxiosError, AxiosResponse } from 'axios';

const apiMixin = {
  mounted() {
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['Accept'] = "application/json"
  },

  methods: {
    async $httpGet<T>(url: string, params?: any): Promise<AxiosResponse<T>> {
      try {
        const response: AxiosResponse<T> = await axios.get(url, { params });
        return response;
      } catch (error) {
        this.handleAxiosError(error);
        throw error;
      }
    },

    async $httpPost<T>(url: string, data?: any): Promise<AxiosResponse<T>> {
      try {
        const response: AxiosResponse<T> = await axios.post(url, data);
        return response;
      } catch (error) {
        this.handleAxiosError(error);
        throw error;
      }
    },

    async $httpPatch<T>(url: string, data?: any): Promise<AxiosResponse<T>> {
      try {
        const response: AxiosResponse<T> = await axios.patch(url, data);
        return response;
      } catch (error) {
        this.handleAxiosError(error);
        throw error;
      }
    },

    async $httpDelete<T>(url: string): Promise<AxiosResponse<T>> {
      try {
        const response: AxiosResponse<T> = await axios.delete(url);
        return response;
      } catch (error) {
        this.handleAxiosError(error);
        throw error;
      }
    },

    // Common error handling method
    handleAxiosError(error: AxiosError) {
      if (error.response && error.response.status === 401) {
        this.$store.dispatch("auth/logout");
        this.$router.push("/login");
      }
    },
  },
}

export default apiMixin
