<template>
  <div>
    <navigation-nav-bar />
    <v-container>
      <v-row>
        <v-col>
          <welcome-message />
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
      
<script lang="ts">
import { defineComponent } from "vue";
import navigationNavBar from '../components/navigation/nav-bar/index.vue'
import welcomeMessage from "../components/text/welcome-message.vue";

export default defineComponent({
  components: {
    navigationNavBar,
    welcomeMessage,
  }
});
</script>
