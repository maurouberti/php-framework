<template>
  <v-list subheader>
    <v-subheader>Tarefas {{ section }}</v-subheader>
    <v-divider></v-divider>

    <div v-for="task in tasks" :key="task.id">
      <v-list-item @click="open(task)">
        <v-list-item-content>
          <v-list-item-title v-text="task.title"></v-list-item-title>
          <v-list-item-subtitle v-text="task.description"></v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>
    </div>
  </v-list>
</template>

<script>
import { eventHub } from "../../eventHub";
import _ from "underscore";

export default {
    props: [
      'section'
    ],
    computed: {
      tasks() {
        const tasks = _.filter(this.$store.state.tasks.all, (data) => {
          return data.section_id == this.section;
        });
        return tasks;
      },
    },
    methods: {
        open(n) {
            eventHub.$emit('open-task', n);
        }
    },
    mounted() {
      this.$store.dispatch("tasks/getAll", this.$route.params.id);
    },
}
</script>