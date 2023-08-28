<template>
  <component :is="tag" class="sub-title">{{ text }}</component>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  props: {
    tag: {
      type: String,
      default: "h2",
    },
    text: {
      type: String,
      default: "",
    },
  }
})
</script>

<style scoped>
.sub-title {
  color: #686868;
}
</style>