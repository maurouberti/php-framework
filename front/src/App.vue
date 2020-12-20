<template>
  <v-app id="app">
    <mmu-header />
    <v-main>
      <v-container>
        <router-view />
      </v-container>
    </v-main>
    <v-footer app>
      &copy; {{ year }}
    </v-footer>
  </v-app>
</template>

<script>
import Header from "./components/Header";

export default {
  name: "App",
  computed: {
    year() {
      return (new Date()).getFullYear();
    }
  },
  components: {
    "mmu-header": Header,
  },
};
</script>
