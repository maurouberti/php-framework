<template>
  <v-row>
    <v-col cols="3" v-for="project in projects" :key="project.id">
      <v-card color="blue-grey darken-2" dark>
        <v-card-title primary-title>{{ project.title }}</v-card-title>
        <v-card-text
          >Texto texto texto texto texto texto texto texto texto texto texto
          texto texto texto texto texto texto</v-card-text
        >
        <v-card-actions>
          <v-btn text :to="'/projects/' + project.id">Ver +</v-btn>
        </v-card-actions>
      </v-card>
    </v-col>

    <v-col cols="3">
      <projects-create></projects-create>
    </v-col>
  </v-row>
</template>

<script>
import ProjectCreate from "./Create";

export default {
  computed: {
    projects() {
      return this.$store.state.projects.all;
    },
  },
  components: {
    "projects-create": ProjectCreate,
  },
};
</script>