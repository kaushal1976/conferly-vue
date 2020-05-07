<template>
  <v-app>
    <v-navigation-drawer app v-model="drawer" :mini-variant.sync="mini">
      <v-list-item class="px-2">
        <v-list-item-avatar>
          <v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
        </v-list-item-avatar>
        <v-list-item-title>John Leider</v-list-item-title>
        <v-btn icon @click.stop="mini = !mini">
          <v-icon>mdi-chevron-left</v-icon>
        </v-btn>
      </v-list-item>
      <Navigation />
    </v-navigation-drawer>
    <v-app-bar app color="indigo darken-2" dark flat dense hide-on-scroll> 
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-toolbar-title>
        Confer
        <b>ly</b>
      </v-toolbar-title>
    </v-app-bar>
    <!-- Content -->
    <v-content>
      <v-container class="ma-0 pa-0" fluid fill-height >
        <router-view></router-view>
      </v-container>
    </v-content>
    <v-footer app absolute>
      <Footer />
    </v-footer>
  </v-app>
</template>
<script>
import Navigation from "./layout/Navigation.vue";
import Footer from "./layout/Footer";
export default {
  data: function() {
    return {
      drawer: false,
      mini: true
    };
  },
  components: {
    Navigation,
    Footer
  }
};
</script>
