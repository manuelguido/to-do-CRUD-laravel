<template>
	<div class="register-container">
		<v-container>
			<v-row justify="center">
				<v-col md="12" lg="6">
					<register-form />
				</v-col>
			</v-row>
		</v-container>
	</div>
</template>
  
<script lang="ts">
import { defineComponent } from "vue";
import saveButton from "../components/button/save-button.vue"
import registerForm from "../components/form/register-form.vue"

export default defineComponent({
	components: {
		saveButton,
		registerForm,
	},
});
</script>
  
<style scoped>
.register-container {
	height: 100dvh;
	display: flex;
	align-items: center;
}
</style>
