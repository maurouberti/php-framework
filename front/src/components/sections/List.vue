<template>
  <v-row>
    <v-col cols="3" v-for="n in 6" :key="n">
      <v-card color="blue-grey lighten-5">
        <v-card-title class="blue-grey white--text"
          >Sessão {{ n }}</v-card-title
        >
        <v-card-text>Abcd abcd abcd</v-card-text>
        <v-card-text>
          <tasks />
        </v-card-text>
        <v-card-text>
          <create-task />
        </v-card-text>
      </v-card>
    </v-col>
    <v-col cols="3">
        <create />
    </v-col>
  </v-row>
</template>

<script>
import create from './Create'
import tasks from '../tasks/List'
import tasksCreate from '../tasks/Create'
export default {
  components: {
    create,
    tasks,
    'create-task': tasksCreate,
  }
}
</script>