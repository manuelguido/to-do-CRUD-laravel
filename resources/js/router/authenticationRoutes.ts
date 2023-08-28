import { RouteRecordRaw } from 'vue-router';
import store from '../store';

import login from '../pages/login.vue';
import register from '../pages/register.vue';

const routes: RouteRecordRaw[] = [
  {
    path: "/login",
    name: "Login",
    component: login,
    // Check if the user is not authenticated
    beforeEnter: (to, from, next) => {
      store.getters['auth/isAuthenticated']
        ? next('/') // Authenticated: User cannot access the login page
        : next(); // Not authenticated: Can access the login page
    },
  },
  {
    path: "/register",
    name: "Register",
    component: register,
    // Check if the user is not authenticated
    beforeEnter: (to, from, next) => {
      store.getters['auth/isAuthenticated']
        ? next('/') // Authenticated: User cannot access the register page
        : next(); // Not authenticated: Can access the register page
    },
  },
];

export default routes;
