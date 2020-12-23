<template>
  <v-row>
    <!-- <v-app-bar flat color="white" clipped-left>
      <v-btn icon><v-icon>arrow_back</v-icon></v-btn>
      <v-toolbar-title>Projetos</v-toolbar-title>
    </v-app-bar> -->

    <v-col cols="12">
      <h2 class="display-1 mb-4">Projetos</h2>
    </v-col>

    <v-container>
      <router-view />
    </v-container>
  </v-row>
</template>

<script>
export default {
  mounted() {
    this.$store.dispatch('projects/getAll');
  }
}
</script>
