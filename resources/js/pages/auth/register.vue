<template>
	<div class="register-container">
			<div class="register-container-inner">
					<register-form />
			</div>
	</div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import registerForm from "../../components/form/register-form.vue";

export default defineComponent({
	components: {
			registerForm,
	},
});
</script>

<style scoped>
.register-container {
	background: url("../assets/img/auth-wallpaper.jpg");
	background-size: cover;
	height: 100dvh;
	width: 100dvw;
}

.register-container-inner {
	display: flex;
	align-items: center;
	justify-content: center;
	height: 100dvh;
	width: 100dvw;

	background: rgb(0, 0, 0);
	background: -moz-linear-gradient(
			0deg,
			rgba(0, 0, 0, 0.5620448863139005) 0%,
			rgba(0, 0, 0, 0.8841737378545168) 100%
	);
	background: -webkit-linear-gradient(
			0deg,
			rgba(0, 0, 0, 0.5620448863139005) 0%,
			rgba(0, 0, 0, 0.8841737378545168) 100%
	);
	background: linear-gradient(
			0deg,
			rgba(0, 0, 0, 0.5620448863139005) 0%,
			rgba(0, 0, 0, 0.8841737378545168) 100%
	);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#000000",endColorstr="#000000",GradientType=1);
}
</style>
