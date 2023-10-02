<template>
    <main class="outer-container">
        <div
            class="brand-container d-flex flex-column justify-center align-center"
        >
            <div class="logo text-blue-grey-darken-3">TO-DO APP</div>
            <div class="logo-under text-blue-grey-lighten-3">(Laravel + Vue)</div>
        </div>

        <div
            class="form-container d-flex flex-column justify-center align-center"
        >
            <!-- Title -->
            <h1 class="mb-6 text-white text-uppercase">Login</h1>
            <!-- /.Title -->

            <!-- Form -->
            <form @submit.prevent="login" class="mb-6">
                <v-text-field
                    v-model="email"
                    label="Email"
                    type="email"
                    :rules="passwordRules"
                    required
                    class="text-white"
                />
                <v-text-field
                    v-model="password"
                    label="Password"
                    type="password"
                    :rules="passwordRules"
                    required
                    class="text-white"
                />
                <save-button text="Login" />
            </form>
            <!-- /.Form -->

            <!-- Register route -->
            <p class="ma-0 text-white">
                Don't have an account yet?
                <router-link to="/register" class="text-white"
                    >Register</router-link
                >
            </p>
            <!-- /.Register route -->
            <v-alert v-if="error" type="warning" :text="error" class="mt-4" />
        </div>
    </main>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import saveButton from "../button/save-button.vue";
import authenticationFormMixin from "../../mixins/authenticationFormMixin";
import apiMixin from "../../mixins/apiMixin";

export default defineComponent({
    mixins: [apiMixin, authenticationFormMixin],
    components: {
        saveButton,
    },
    data() {
        return {
            error: "" as string,
        };
    },
    methods: {
        async login(): Promise<any> {
            const url: string = "/api/login";
            const loginParams = { email: this.email, password: this.password };

            this.$httpPost(url, loginParams)
                .then((response: any) => {
                    this.$store.dispatch("auth/login", response.data);
                    this.$router.push({ name: "Home" });
                })
                .catch((error) => {
                    this.error = error.response.data.message;
                });
        },
    },
});
</script>

<style scoped>
.outer-container {
    display: inline-flex;
    justify-content: space-between;
    align-content: center;
    height: calc(100% - 15dvw);
    border-radius: 12px;
    overflow: hidden;
    width: 85dvw;

    background: rgba(255, 255, 255, 0.05);
    border-radius: 1rem;
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
}

.brand-container,
.form-container {
    width: 50%;
    height: 100%;
    /* padding: 5rem; */
}

.brand-container {
    background: rgba(255, 255, 255, 1);
}

.logo {
    font-weight: 800;
    font-size: 50pt;
}

.logo-under {
    font-weight: 800;
    font-size: 25pt;
}

form {
  width: 100%;
  padding: 0 5rem;
}
</style>
