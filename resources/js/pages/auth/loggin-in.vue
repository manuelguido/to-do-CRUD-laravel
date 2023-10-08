<template>
    <div>
        <!-- <h1>Welcome, {{ loginData }}</h1> -->
    </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import axios from 'axios';

export default defineComponent({
    props: {
        loginData: {
            type: String, // Assuming the data is passed as a JSON string
            required: true,
        },
    },
    computed: {
        parsedLoginData() {
            return JSON.parse(this.loginData);
        },
    },
    mounted() {
        this.retrieveData();
    },
    methods: {
        async mounted() {
            // Check if the session contains oauth_data
            const oauthData = sessionStorage.getItem("oauth_data");
            if (oauthData) {
                this.oauthData = JSON.parse(oauthData);
                // You can now access this.oauthData.user and this.oauthData.access_token
                console.log(this.oauthData.user);
                console.log(this.oauthData.access_token);

                // Optionally, clear the session data after processing it
                sessionStorage.removeItem("oauth_data");
            }
        },
    },
});
</script>
