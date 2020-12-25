<template>
  <v-form v-model="valid" ref="form">
    <v-text-field
      label="Descrição da tarefa"
      v-model="data.description"
      :rules="validation.description"
      required
    ></v-text-field>

    <v-menu
      ref="menuTime"
      v-model="menu"
      :close-on-content-click="false"
      :return-value.sync="due_date_time"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-text-field
          v-bind="attrs"
          v-on="on"
          slot="activator"
          v-model="due_date_time"
          label="Hora"
          readonly
        ></v-text-field>
      </template>
      <v-time-picker v-model="due_date_time">
        <v-btn text color="secondary" @click="menu = false">Cancelar</v-btn>
        <v-btn text color="primary" @click="$refs.menuTime.save(due_date_time)"
          >Ok</v-btn
        >
      </v-time-picker>
    </v-menu>

    <v-btn :disabled="!valid" @click="submit()">Salvar</v-btn>
  </v-form>
</template>

<script>
import { eventHub } from "../../eventHub";

export default {
  props: ["date"],
  data() {
    return {
      menu: false,
      valid: false,
      data: {},
      due_date_time: "12:00",
      validation: {
        description: [(v) => !!v || "Título é obrigatório"],
      },
    };
  },
  methods: {
    submit() {
      this.data.due_date = this.date + " " + this.due_date_time + ":00";
      this.$store.dispatch("schedules/create", this.data).then(() => {
        this.$refs.form.reset();
        this.due_date_time = null;

        eventHub.$emit("schedules_created");
      });
    },
  },
};
</script>