<template>
	<v-btn color="teal-darken-4" type="submit" size="x-large" block variant="flat">
		{{ text }}
	</v-btn>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
	props: {
		text: {
			type: String,
			default: "",
		},
	},
});
</script>
