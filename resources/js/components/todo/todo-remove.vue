<template>
  <v-list-item start>
    <v-list-item-action>
      <v-btn icon="mdi-close" flat @click="removeTodoItem()" />
    </v-list-item-action>
  </v-list-item>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import apiMixin from '../../mixins/apiMixin';

export default defineComponent({
  mixins: [apiMixin],
  props: {
    todoId: {
      type: Number,
      required: true,
    },
  },
  methods: {

    async removeTodoItem(): Promise<any> {
      const url: string = `/api/todo-item/${this.todoId}`;

      this.$httpDelete(url)
        .then(() => {
          this.$store.commit('todo/removeTodo', this.todoId);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  }
})
</script>
