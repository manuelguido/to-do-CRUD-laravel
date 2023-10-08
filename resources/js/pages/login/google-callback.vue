<template>
    <div></div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import apiMixin from "../../mixins/apiMixin";

export default defineComponent({
    mixins: [apiMixin],
    async mounted() {
        await this.login();
    },
    methods: {
        async login(): Promise<any> {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has("code")) {
                const code = urlParams.get("code");
                const url: string = `/api/login/google/callback?code=${code}`;

                this.$httpGet(url)
                    .then((response: any) => {
                        this.$store.dispatch("auth/login", response.data);
                        this.$router.push({ name: "Home" });
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        },
    },
});
</script>
