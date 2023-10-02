import './bootstrap';

// Vue setup
import { createApp } from 'vue';
import app from './App.vue';
import router from './router/index.ts'
import store from './store';

// Vuetify setup
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

import { fa } from "vuetify/iconsets/fa";
import { aliases, mdi } from "vuetify/lib/iconsets/mdi";
import "@mdi/font/css/materialdesignicons.css";
import "@fortawesome/fontawesome-free/css/all.css";
import "../css/custom/index.css";

const vuetify = createVuetify({
  theme: {
    defaultTheme: "light",
  },
  icons: {
    defaultSet: "mdi",
    aliases,
    sets: {
      mdi,
      fa,
    },
  },
  components,
  directives,
});

// Vue Application setup
createApp(app).use(router).use(store).use(vuetify).mount("#app")
