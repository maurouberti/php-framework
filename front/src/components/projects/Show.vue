<template>
  <v-row>
    <v-col cols="12">
      <h2 class="display-0 mb-2">{{ project.title }}</h2>
      <p>
        {{ project.description }}
      </p>
      <sections />
      <v-btn to="/projects">Voltar</v-btn>
    </v-col>

    <show-task />
  </v-row>
</template>

<script>
import Sections from "../sections/List";
import showTask from "../tasks/Show";

export default {
  computed: {
    project() {
      const id = this.$route.params.id;
      return this.$store.getters['projects/byId'](id);
    }
  },
  components: {
    sections: Sections,
    "show-task": showTask,
  },
};
</script>