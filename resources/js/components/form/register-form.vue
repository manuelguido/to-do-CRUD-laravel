<template>
  <main>
    <div class="form-container">
      <h1 class="mb-6">Register</h1>
      <form @submit.prevent="register" class="mb-6">
        <v-text-field v-model="name" label="Full name" required />
        <v-text-field v-model="email" label="Email" type="email" :rules="passwordRules" required />
        <v-text-field v-model="password" label="Password" type="password" :rules="passwordRules" required />
        <save-button text="Register" />
      </form>
      <p class="ma-0">
        Already registered?
        <router-link to="/login">Login</router-link>
      </p>
    </div>

    <v-alert v-if="error" type="warning" :text="error" class="mt-4" />
  </main>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import saveButton from "../button/save-button.vue"
import authenticationFormMixin from "../../mixins/authenticationFormMixin"
import apiMixin from "../../mixins/apiMixin"

export default defineComponent({
  mixins: [apiMixin, authenticationFormMixin],
  components: {
    saveButton,
  },
  data() {
    return {
      name: "" as string,
      nameRules: [
        value => {
          if (value) return true
          return 'Name is required.'
        },
      ] as Array<Function>,
      error: "" as string,
    };
  },
  methods: {
    async register(): Promise<any> {
      this.errors = "";

      const url: string = "/api/register";
      const loginParams = { name: this.name, email: this.email, password: this.password };

      this.$httpPost(url, loginParams)
        .then((response: any) => {
          this.$store.dispatch('auth/login', response.data);
          this.$router.push({ name: 'Home' })
        })
        .catch((error) => {
          this.error = error.response.data.message
        })
    },
  }
})
</script>

<style scoped>
.form-container {
  padding: 1.5rem;
  background: #eee;
  border-radius: 0.75rem;
}
</style>