/*
|--------------------------------------------------------------------------
| This Mixin defines common data handled by Login and Register forms
|--------------------------------------------------------------------------
*/
import apiMixin from "./apiMixin"

const authenticationFormMixin = {
  mixin: [apiMixin],
  data() {
    return {
      email: "" as string,
      password: "" as string,
      emailRules: [
        value => {
          if (value) return true
          return 'Email is required.'
        },
      ] as Array<Function>,
      passwordRules: [
        value => {
          if (value) return true
          return 'Password is required.'
        },
        value => {
          if (value?.length >= 8) return true
          return 'Password must be at least 8 characters.'
        },
      ] as Array<Function>,
    }
  },
  mounted() {
    this.requestToken
  },
  methods: {
    // Request Sanctum CSRF cookie
    async requestToken(): Promise<any> {
      this.$httpGet('/sanctum/csrf-cookie')
        .then((response: any) => {
          console.log(response)
        })
        .catch((error) => {
          this.error = error.response.data.message;
        });
    },
  }
};

export default authenticationFormMixin
