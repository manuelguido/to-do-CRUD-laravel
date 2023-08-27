import { createStore } from 'vuex';
import createPersistedState from 'vuex-persistedstate';

import auth from './modules/auth';

const store = createStore({
    modules: {
        'auth': auth,
    },
    plugins: [
        createPersistedState({
            storage: window.localStorage, // Use localStorage as the storage engine
            paths: ['auth'],
        }),
    ],
});

export default store;
