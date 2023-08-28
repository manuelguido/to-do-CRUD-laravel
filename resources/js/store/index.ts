import { createStore } from 'vuex';
import createPersistedState from 'vuex-persistedstate';

import auth from './modules/auth';
import toDo from './modules/todo';

const store = createStore({
    modules: {
        'auth': auth,
        'todo': toDo,
    },
    plugins: [
        createPersistedState({
            storage: window.localStorage,
            paths: ['auth'],
        }),
    ],
});

export default store;
