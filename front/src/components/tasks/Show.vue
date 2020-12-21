<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" fullscreen>
      <v-card>
        <v-toolbar flat dark color="primary">
          <v-btn icon dark @click="dialog = false">
            <v-icon>close</v-icon>
          </v-btn>
          <v-toolbar-title>Tarefa</v-toolbar-title>
        </v-toolbar>

        <v-card-text>
          <h3>Teste</h3>
        </v-card-text>
        
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import { eventHub } from "../../eventHub";
export default {
  data() {
    return {
      dialog: false,
    };
  },
  created() {
    eventHub.$on("open-task", (n) => {
      this.dialog = true;
    });
  },
};
</script>