<template>
  <!-- Checkbox -->
  <v-list-item start>
    <v-checkbox-btn :model-value="isChecked" @change="updateTodoStatus" />
  </v-list-item>
  <!-- /.Checkbox -->
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
  computed: {
    isChecked: {
      get() {
        return Boolean(this.todoItem.is_finished);
      },
      set(value) {
        this.updateTodoStatus(value);
      },
    },
  },
  methods: {
    updateTodoStatus(newValue: boolean) {
      const url: string = `/api/todo-item/${this.todoItem.id}/status`;
      const parameters = { is_finished: Boolean(newValue) };

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
})
</script>
