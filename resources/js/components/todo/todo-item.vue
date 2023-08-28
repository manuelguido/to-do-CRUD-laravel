<template>
  <v-list-item>
    <!-- Checkbox -->
    <template v-slot:prepend>
      <todo-update-status :todo-item="todoItem" />
    </template>
    <!-- /.Checkbox -->

    <!-- Content -->
    <div class="d-flex justify-space-between align-items-center">
      <div class="d-flex flex-row justify-content-start align-items-center">
        <!-- Name -->
        <v-list-item-title v-if="!editing">
          {{ todoItem.name }}
        </v-list-item-title>
        <todo-update v-else :todo-item="todoItem" @editing:disable="editing = false" />
        <!-- Name -->
      </div>
    </div>

    <!-- Checkbox -->
    <template v-slot:append>
      <todo-edit :todo-item="todoItem" @click="toggleEditing" />
      <todo-remove :todo-id="todoItem.id" />
    </template>
    <!-- /.Checkbox -->

  </v-list-item>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import todoEdit from "./todo-edit.vue"
import todoUpdate from "./todo-update.vue"
import todoRemove from "./todo-remove.vue"
import todoUpdateStatus from "./todo-update-status.vue"
import { TodoItem } from '../../models/todo-item.model'

export default defineComponent({
  props: {
    todoItem: {
      type: Object as () => TodoItem,
      required: true,
    },
  },
  data() {
    return {
      editing: false as boolean,
    }
  },
  components: {
    todoEdit,
    todoUpdate,
    todoRemove,
    todoUpdateStatus,
  },
  methods: {
    toggleEditing(): void {
      this.editing = !this.editing
    }
  }
})
</script>
