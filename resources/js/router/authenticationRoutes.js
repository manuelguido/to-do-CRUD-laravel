import store from '@/store';

import login from '../pages/login.vue';
import register from '../pages/register.vue';


const routes = [
    {
        path: "/login",
        name: "Login",
        component: login,
        // Check if the user is not authenticated
        beforeEnter: (to, from, next) => {
            (store.getters['auth/isAuthenticated'])
                ? next('/') // Authenticated: User can not access to login page
                : next(); // Not authenticated: It can access login page
        },
    },
    {
        path: "/register",
        name: "Register",
        component: register,
        // Check if the user is not authenticated
        beforeEnter: (to, from, next) => {
            (store.getters['auth/isAuthenticated'])
                ? next('/') // Authenticated: User can not access to register page
                : next(); // Not authenticated: It can access login page
        },
    }
]

export default routes
