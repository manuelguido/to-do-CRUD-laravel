<template>
    <p class="ma-0 text-white">
        {{ message }}
        <router-link :to="route.url" class="text-white">
            {{ route.text }}
        </router-link>
    </p>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
    props: {
        message: {
            type: String,
            required: true,
        },
        route: {
            type: Object,
            required: true,
        },
    },
});
</script>
