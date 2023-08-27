<template>
  <h1>{{ message }}</h1>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { mapGetters } from 'vuex';

export default defineComponent({
  computed: {
    ...mapGetters({
      user: 'auth/user'
    }),

    message(): string {
      return `Welcome ${this.user?.name || ""}`;
    }
  }
})
</script>
