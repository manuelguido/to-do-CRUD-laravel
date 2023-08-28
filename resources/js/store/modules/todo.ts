import { TodoItem } from "../../models/todo-item.model";

const state = {
    todos: [] as Array<TodoItem>,
};

const mutations = {
    // Add to-do to state
    addTodo(state: { todos: TodoItem[] }, todo: TodoItem) {
        state.todos.push(todo);
    },

    // Remove to-do from state by index
    removeTodo(state: { todos: TodoItem[] }, todoId: number) {
        const index = state.todos.findIndex((t) => t.id === todoId);
        if (index !== -1) {
            state.todos.splice(index, 1);
        }
    },

    // Mark to-do as finished state by index
    updateTodo(state: { todos: TodoItem[] }, todo: TodoItem) {
        const index = state.todos.findIndex((t) => t.id === todo.id);
        if (index !== -1) {
            state.todos[index].name = todo.name;
        }
    },

    // Mark to-do as finished state by index
    updateTodoStatus(state: { todos: TodoItem[] }, todo: TodoItem) {
        const index = state.todos.findIndex((t) => t.id === todo.id);
        if (index !== -1) {
            state.todos[index].is_finished = todo.is_finished;
        }
    },
};

const getters = {
    todoList: (state) => state.todos
};

export default {
    namespaced: true,
    state,
    mutations,
    getters,
};
