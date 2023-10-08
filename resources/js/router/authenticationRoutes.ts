import { RouteRecordRaw } from 'vue-router';
import store from '../store';

import authGoogle from '../pages/auth/google.vue';
import login from '../pages/auth/login.vue';
import loginGoogleCallback from '../pages/login/google-callback.vue';
import register from '../pages/auth/register.vue';

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
  {
    path: "/auth/google",
    name: "AuthGoogle",
    component: authGoogle,
    // Check if the user is not authenticated
    beforeEnter: (to, from, next) => {
      store.getters['auth/isAuthenticated']
        ? next('/') // Authenticated: User cannot access the login page
        : next(); // Not authenticated: Can access the login page
    },
  },
  {
    path: "/login/google/callback",
    name: "LoginGoogleCallback",
    component: loginGoogleCallback,
  },
];

export default routes;
