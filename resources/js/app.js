import './bootstrap';

// Vue setup
import { createApp } from 'vue';
import app from './App.vue';
import router from './router/index.js'
import store from './store';

// Vuetify setup
import { createVuetify } from 'vuetify'
const vuetify = createVuetify()
import 'vuetify/styles'

// Vue Application setup
createApp(app).use(router).use(store).use(vuetify).mount("#app")
