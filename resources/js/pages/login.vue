<template>
	<div class="login-container deep-orange-lighten-5">
		<v-container>
			<v-row justify="center">
				<v-col md="12" lg="6">
					<login-form />
				</v-col>
			</v-row>
		</v-container>
	</div>
</template>
  
<script lang="ts">
import { defineComponent } from "vue";
import loginForm from "../components/form/login-form.vue"

export default defineComponent({
	components: {
		loginForm,
	},
});
</script>
  
<style scoped>
.login-container {
	height: 100dvh;
	display: flex;
	align-items: center;
}
</style>
