<template>
	<form @submit.prevent="logout">
		<v-btn color="teal-lighten-1" type="submit" variant="flat">{{ buttonText }}</v-btn>
	</form>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import axios from "axios";

export default defineComponent({
	data() {
		return {
			buttonText: "Logout" as string,
		};
	},
	methods: {
		async logout() {
			try {
				const token = this.$store.getters["auth/getToken"];

				await axios.post("/api/logout", {}, {
					headers: {
						Authorization: `Bearer ${token}`,
					},
				});

				await this.$store.dispatch("auth/logout");

				this.$router.push("/login");
			} catch (error) {
				console.error("Logout error:", error);
			}
		},
	},
});
</script>
