<template>
  <div>
    <dtemplate v-if="isLogged" />
    <login v-if="!isLogged" />
  </div>
</template>

<script>
import dtemplate from './templates/default.vue';
import login from './templates/login.vue';

export default {
  components: {
    dtemplate,
    login
  },
  computed: {
    isLogged() {
      return this.$store.state.auth.isLogged;
    }
  }
};
</script>
