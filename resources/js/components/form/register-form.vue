<template>
    <main class="outer-container">
        <brand-container />

        <div
            class="form-container d-flex flex-column justify-center align-center"
        >
            <!-- Title -->
            <h1 class="mb-6 text-white text-uppercase">Register</h1>
            <!-- /.Title -->

            <!-- Form -->
            <form @submit.prevent="register" class="mb-6">
                <v-text-field
                    v-model="name"
                    label="Full name"
                    required
                    class="text-white"
                />
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
                <save-button text="Register" />
            </form>
            <!-- /.Form -->

            <!-- Register route -->
            <redirect-link
                message="Already registered?"
                :route="{ url: '/login', text: 'Login' }"
            />
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
import brandContainer from "./brand-container.vue";
import redirectLink from "./redirect-link.vue";

export default defineComponent({
    mixins: [apiMixin, authenticationFormMixin],
    components: {
        saveButton,
        brandContainer,
        redirectLink,
    },
    data() {
        return {
            name: "" as string,
            nameRules: [
                (value) => {
                    if (value) return true;
                    return "Name is required.";
                },
            ] as Array<Function>,
            error: "" as string,
        };
    },
    methods: {
        async register(): Promise<any> {
            this.errors = "";

            const url: string = "/api/register";
            const loginParams = {
                name: this.name,
                email: this.email,
                password: this.password,
            };

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

.form-container {
    width: 50%;
    height: 100%;
    /* padding: 5rem; */
}

form {
    width: 100%;
    padding: 0 5rem;
}
</style>
