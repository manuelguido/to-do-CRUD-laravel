import './bootstrap';

import { createApp } from 'vue';
import app from './App.vue';
import router from './router/index.js'
import { createVuetify } from 'vuetify'
const vuetify = createVuetify()

createApp(app).use(router).use(vuetify).mount("#app")
