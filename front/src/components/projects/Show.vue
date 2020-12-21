<template>
  <v-row>
    <v-col cols="12">
      <h2 class="display-0 mb-2">Nome do Projeto</h2>
      <p>
        Texto texto texto texto texto texto texto texto texto texto texto texto
        texto texto texto
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
  components: {
    sections: Sections,
    "show-task": showTask,
  },
};
</script>