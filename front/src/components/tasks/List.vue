<template>
  <v-list three-line subheader>
    <v-subheader>Tarefas</v-subheader>
    <v-divider></v-divider>

    <div v-for="n in 3" :key="n">
      <v-list-item @click="open(n)">
        <v-list-item-content>
          <v-list-item-title v-text="'Titulo'"></v-list-item-title>
          <v-list-item-subtitle v-text="'sub-titulo'"></v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>
    </div>
  </v-list>
</template>

<script>
import { eventHub } from "../../eventHub";
export default {
    methods: {
        open(n) {
            eventHub.$emit('open-task', n);
        }
    },
}
</script>