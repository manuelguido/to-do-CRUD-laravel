<template>
  <form method="POST" class="d-flex justify-content-between align-items-center" @submit.prevent="updateTodo">
    <v-text-field v-model="todoItem.name" label="Update your to-do item" class="mr-5" type="text" :hide-details="true"
      required />
    <v-btn color="teal-darken-4" type="submit" size="large" variant="flat" class="h-auto">
      Update
    </v-btn>
  </form>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { TodoItem } from "../../models/todo-item.model"
import apiMixin from '../../mixins/apiMixin';

export default defineComponent({
  mixins: [apiMixin],
  props: {
    todoItem: {
      type: Object as () => TodoItem,
      required: true,
    },
  },
  methods: {
    async updateTodo(): Promise<any> {
      const url: string = `/api/todo-item/${this.todoItem.id}`;
      const parameters = { name: this.todoItem.name };

      this.$httpPatch(url, parameters)
        .then((response: any) => {
          this.$store.commit('todo/updateTodo', response.data.todo_item);
          this.$emit("editing:disable");
        })
        .catch((error) => {
          console.log(error);
        })
    },
  }
});
</script>

<style scoped>
form {
  min-width: 400px;
}
</style>