<template>
  <div>
    <v-navigation-drawer v-model="drawer" clipped app>
      <v-list dense>
        <v-list-item
          v-for="item in items"
          :key="item.title"
          :to="item.route"
          link
        >
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar flat color="amber" clipped-left app>
      <v-app-bar-nav-icon @click="drawer = !drawer">
        <v-icon>menu</v-icon>
      </v-app-bar-nav-icon>

      <v-toolbar-title>Gerenciamento de Projetos</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn @click="logout()" icon><v-icon>exit_to_app</v-icon></v-btn>
    </v-app-bar>
  </div>
</template>

<script>
export default {
  data() {
    return {
      drawer: true,
      items: [
        { title: "Projetos", icon: "dashboard", route: "/projects" },
        { title: "Agenda", icon: "schedule", route: "/schedule" },
      ],
    };
  },
  methods: {
    logout() {
      this.$store.dispatch('auth/logout');
    }
  }
};
</script>
