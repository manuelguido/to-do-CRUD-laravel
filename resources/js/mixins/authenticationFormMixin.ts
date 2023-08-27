/*
|--------------------------------------------------------------------------
| This Mixin defines common data handled by Login and Register forms
|--------------------------------------------------------------------------
*/

const authenticationFormMixin = {
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
  }
};

export default authenticationFormMixin
