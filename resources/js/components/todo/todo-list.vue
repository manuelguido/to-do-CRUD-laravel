<template>
    <!-- Card -->
    <v-card class="mx-auto">
        <!-- Toolbar -->
        <v-toolbar color="teal-darken-4">
            <v-toolbar-title>Todo items</v-toolbar-title>
        </v-toolbar>
        <!-- /.Toolbar -->

        <!-- List -->
        <v-list>
            <!-- Items -->
            <todo-item
                v-for="(todoItem, index) in todos"
                :key="index"
                :todo-item="todoItem"
            />
            <!-- /.Items -->
        </v-list>
        <!-- /.List -->
    </v-card>
    <!-- /.Card -->
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { mapGetters } from "vuex";
import apiMixin from "../../mixins/apiMixin";
import todoItem from "./todo-item.vue";
import { TodoItem } from "../../models/todo-item.model";

export default defineComponent({
    mixins: [apiMixin],
    components: {
        todoItem,
    },
    mounted() {
        this.fetchTodoList();
    },
    computed: {
        ...mapGetters({
            todos: "todo/todoList",
        }),
    },
    methods: {
        async fetchTodoList(): Promise<any> {
            const url: string = "/api/todo-item";

            this.$httpGet(url)
                .then((response: any) => {
                    const todos: TodoItem[] = response.data;
                    this.$store.commit("todo/addTodos", todos);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
});
</script>
