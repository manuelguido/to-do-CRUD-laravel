<template>
	<form method="POST" class="d-flex justify-content-between align-items-center" @submit.prevent="addTodo">
		<v-text-field v-model="newTodo" label="Write your to-do item" class="mr-5 mb-0" type="text" required />
		<v-btn color="teal-darken-4" type="submit" size="x-large" variant="flat">
			Add
		</v-btn>
	</form>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import apiMixin from '../../mixins/apiMixin';

export default defineComponent({
	mixins: [apiMixin],
	data() {
		return {
			newTodo: "" as string,
		}
	},
	methods: {
		async addTodo(): Promise<any> {
			const url: string = "/api/todo-item";
			const parameters = { name: this.newTodo };

			this.$httpPost(url, parameters)
				.then((response: any) => {
					this.$store.commit('todo/addTodo', response.data.todo_item);
					this.newTodo = ""
				})
				.catch((error) => {
					console.log(error);
				})
		},
	}
})
</script>
