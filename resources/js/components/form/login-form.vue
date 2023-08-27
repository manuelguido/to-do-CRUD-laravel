<template>
  <main>
    <div class="form-container">
      <!-- Title -->
      <h1 class="mb-6">Login</h1>
      <!-- /.Title -->

      <!-- Form -->
      <form @submit.prevent="login" class="mb-6">
        <v-text-field v-model="email" label="Email" type="email" :rules="passwordRules" required />
        <v-text-field v-model="password" label="Password" type="password" :rules="passwordRules" required />
        <save-button text="Login" />
      </form>
      <!-- /.Form -->

      <!-- Register route -->
      <p class="ma-0">
        Don't have an account yet?
        <router-link to="/register">Register</router-link>
      </p>
      <!-- /.Register route -->
      <v-alert v-if="error" type="warning" :text="error" class="mt-4" />
    </div>

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
      error: "" as string,
    }
  },
  methods: {
    async login(): Promise<any> {
      const url: string = "/api/login";
      const loginParams = { email: this.email, password: this.password };

      this.$httpPost(url, loginParams)
        .then((response: any) => {
          this.$store.dispatch('auth/login', response.data);
          this.$router.push({ name: 'Home' })
        })
        .catch((error) => {
          this.error = error.response.data.message;
        })
    },
  }
})
</script>


<style scoped>
.form-container {
  padding: 2rem;
  background: #eee;
  border-radius: 4px;
}
</style>
