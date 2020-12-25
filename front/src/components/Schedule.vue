<template>
  <v-row>
    <v-col cols="12">
      <h2 class="display-1 mb-4">Agenda</h2>
    </v-col>

    <v-col cols="6">
      <v-date-picker
        v-model="date"
        locale="pt-br"
        scrollable
        landscape
        full-width
        :events="events"
        event-color="green lighten-1"
        color="green lighten-1"
      ></v-date-picker>
      <v-btn dark @click="goToToday()">ir para hoje</v-btn>

      <v-card class="mt-4" v-if="date">
        <v-card-title> Novo evento </v-card-title>
        <v-card-text>
          <create :date="date" />
        </v-card-text>
      </v-card>
    </v-col>

    <v-col cols="6">
      <v-card color="green lighten-5" v-if="date">
        <v-card-title primary-title class="green white--text">
          {{ date }}
        </v-card-title>
        <v-card-text>
          <p>Total de eventos: {{ today.length }}</p>
          <v-list>
            <v-list-item v-for="(event, index) in today" :key="index">
              <v-list-item-content>
                <v-list-item-title>{{ event.description }}</v-list-item-title>
                <v-list-item-subtitle>{{
                  event.due_date.substr(11, event.due_date.length)
                }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card-text>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import _ from "underscore";
import create from "./schedules/Create";
import { eventHub } from "../eventHub";

export default {
  components: {
    create,
  },
  data() {
    return {
      date: null,
      today: [],
    };
  },
  computed: {
    events() {
      return this.schedules.map((item) => {
        const date = item.due_date;
        return date.substr(0, 10);
      });
    },
    schedules() {
      return this.$store.state.schedules.all;
    },
  },
  watch: {
    date: function (to, from) {
      this.filterToDate(to);
    },
  },
  methods: {
    goToToday() {
      this.date = null;
      setTimeout(() => {
        const date = new Date();
        this.date = date.toISOString().substr(0, 10);
      }, 100);
    },
    filterToDate(to) {
      const events = _.filter(this.schedules, (item) => {
        let date = item.due_date;
        date = date.substr(0, 10);
        return date == to;
      });
      this.today = events;
    },
  },
  mounted() {
    this.$store.dispatch("schedules/getAll");
    
    eventHub.$on("schedules_created", () => {
      this.filterToDate(this.date);
    });
  },
};
</script>