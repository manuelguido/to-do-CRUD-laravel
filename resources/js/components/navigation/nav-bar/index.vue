<template>
	<nav class="navbar">
		<nav-bar-title />
		<nav-bar-logout-button />
	</nav>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import navBarTitle from "./title.vue";
import navBarLogoutButton from "./logout-button.vue";

export default defineComponent({
	components: {
		navBarTitle,
		navBarLogoutButton
	}
});
</script>

<style scoped>
.navbar {
	align-items: center;
	background-color: #f5f5f5;
	display: flex;
	justify-content: space-between;
	padding: 1rem;
	width: 100%;
}
</style>
