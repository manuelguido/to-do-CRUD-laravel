<template>
	<form @submit.prevent="logout">
		<v-btn color="teal-darken-4" type="submit" variant="outlined" append-icon="mdi-logout" size="large">{{ buttonText }}</v-btn>
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
