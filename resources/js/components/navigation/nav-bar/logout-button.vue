<template>
	<form @submit.prevent="logout">
		<v-btn color="teal-darken-4" type="submit" variant="outlined" append-icon="mdi-logout" size="large">{{ buttonText
		}}</v-btn>
	</form>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import apiMixin from "../../../mixins/apiMixin";

export default defineComponent({
	mixins: [apiMixin],
	data() {
		return {
			buttonText: "Logout" as string,
		};
	},
	methods: {
		async logout(): Promise<any> {
			const url: string = "/api/logout";

			this.$httpPost(url)
				.then(() => {
					this.$store.dispatch("auth/logout");
					this.$router.push("/login");
				})
				.catch((error) => {
					console.log(error)
				})
		},
	},
});
</script>
