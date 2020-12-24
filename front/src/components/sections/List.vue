<template>
  <v-row>
    <v-col cols="3" v-for="section in sections" :key="section.id">
      <v-card color="blue-grey lighten-5">
        <v-card-title class="blue-grey white--text">{{ section.title }}</v-card-title>
        <v-card-text class="mt-2">{{ section.description }}</v-card-text>
        <v-card-text>
          <tasks :section="section.id" />
        </v-card-text>
        <v-card-text>
          <create-task :section="section.id" />
        </v-card-text>
      </v-card>
    </v-col>
    <v-col cols="3">
      <create />
    </v-col>
  </v-row>
</template>

<script>
import create from "./Create";
import tasks from "../tasks/List";
import tasksCreate from "../tasks/Create";
export default {
  computed: {
    sections() {
      return this.$store.state.sections.all;
    },
  },
  components: {
    create,
    tasks,
    "create-task": tasksCreate,
  },
  mounted() {
    this.$store.dispatch("sections/getAll", this.$route.params.id);
  },
};
</script>