<template>
  <v-row>
    <v-col cols="3" v-for="n in 5" :key="n">
      <v-card color="blue-grey" dark>
        <v-card-title primary-title>Título</v-card-title>
        <v-card-text
          >Texto texto texto texto texto texto texto texto texto texto texto
          texto texto texto texto texto texto</v-card-text
        >
        <v-card-actions>
          <v-btn text>Ver +</v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>