import { createRouter, createWebHistory } from "vue-router";

import home from '../pages/home.vue'

const routes = [
    {
        path: "/",
        name: "Home",
        component: home
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router