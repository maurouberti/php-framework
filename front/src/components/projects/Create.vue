<template>
  <v-card color="blue-grey lighten-4">
    <v-card-title>Adicionar projeto</v-card-title>
    <v-container>
      <v-form cols="12" ref="form" v-model="valid">
        <v-text-field
          id="project-title"
          v-model="data.title"
          label="Título"
          :rules="validation.title"
          required
        ></v-text-field>

        <div v-show="data.title">
          <v-text-field
            v-model="data.description"
            label="Descrição"
            outline
          ></v-text-field>

          <v-menu
            ref="menu"
            v-model="menu"
            :close-on-content-click="false"
            :return-value.sync="due_date"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-text-field
                v-bind="attrs"
                v-on="on"
                v-model="due_date"
                label="Data de entrega"
                readonly
              ></v-text-field>
            </template>
            <v-date-picker
              v-model="due_date"
              locale="pt-br"
              no-title
              scrollable
            >
              <v-btn text color="secondary" @click="menu = false"
                >Cancelar</v-btn
              >
              <v-btn text color="primary" @click="$refs.menu.save(due_date)"
                >Ok</v-btn
              >
            </v-date-picker>
          </v-menu>

          <v-menu
            ref="menuTime"
            v-model="menu2"
            :close-on-content-click="false"
            :return-value.sync="due_date_time"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-text-field
                v-bind="attrs"
                v-on="on"
                slot="activator"
                v-model="due_date_time"
                label="Hora da entrega"
                readonly
              ></v-text-field>
            </template>
            <v-time-picker v-model="due_date_time">
              <v-btn text color="secondary" @click="menu2 = false"
                >Cancelar</v-btn
              >
              <v-btn
                text
                color="primary"
                @click="$refs.menuTime.save(due_date_time)"
                >Ok</v-btn
              >
            </v-time-picker>
          </v-menu>
          <v-btn text @click="submit()">Salvar</v-btn>
        </div>
      </v-form>
    </v-container>
  </v-card>
</template>


<script>
export default {
  data() {
    return {
      valid: false,
      menu: false,
      menu2: false,
      data: {},
      due_date: null,
      due_date_time: "12:00",
      validation: {
        title: [(v) => !!v || "Título é obrigatório"],
      },
    };
  },
  methods: {
    submit() {
      this.data.due_date = this.due_date + " " + this.due_date_time + ":00";
      this.$store.dispatch("projects/create", this.data);
    },
  },
};
</script>