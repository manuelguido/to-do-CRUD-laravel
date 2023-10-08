import { createRouter, createWebHistory } from "vue-router";
import { useStore } from 'vuex';

import home from '../pages/home.vue'
import authenticationRoutes from './authenticationRoutes';

const routes = [
    {
        path: "/",
        name: "Home",
        component: home,
        // Check if the user is authenticated
        beforeEnter: (to, from, next) => {
            const store = useStore();
            store.getters['auth/isAuthenticated']
                ? next() // Authenticated: Allow access to home page
                : next('/login'); // Not authenticated: Redirect to the login page
        },
    },
    ...authenticationRoutes
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router
