<template>
	<v-btn color="blue-grey-darken-1" type="submit" size="x-large" block variant="flat">
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
