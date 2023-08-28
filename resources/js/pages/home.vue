<template>
  <div>
    <navigation-nav-bar />
    <v-container>
      <v-row>
        <v-col>
          <welcome-message />
          <sub-title :text="subtitle" class="mb-8" />
          
          <!-- Todo Section -->
          <div>
            <todo-add />
            <todo-list />
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
      
<script lang="ts">
import { defineComponent } from "vue";
import navigationNavBar from '../components/navigation/nav-bar/index.vue'
import welcomeMessage from "../components/text/welcome-message.vue";
import subTitle from "../components/text/sub-title.vue";
import todoAdd from "../components/todo/todo-add.vue";
import todoList from "../components/todo/todo-list.vue";

export default defineComponent({
  components: {
    navigationNavBar,
    welcomeMessage,
    subTitle,
    todoAdd,
    todoList,
  },
  data() {
    return {
      subtitle: "Here you can find your to-do lists" as string,
    }
  }
});
</script>
