<template>
    <h1 class="navbar-title">{{ title }}</h1>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
    data() {
        return {
            title: "To-do App" as string,
        }
    }
});
</script>

<style scoped>
.navbar-title {
    font-size: 1.25rem;
}
</style>
