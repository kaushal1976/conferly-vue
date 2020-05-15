<template>
  <v-col cols="12" class="mx-auto">
    <v-list-item>
      <v-list-item-avatar color="grey"></v-list-item-avatar>
      <v-list-item-content>
        <v-list-item-title class="headline">Themes for {{conference.title}}</v-list-item-title>
        <v-list-item-subtitle>Manage themes</v-list-item-subtitle>
        <v-spacer></v-spacer>
      </v-list-item-content>
      <v-btn icon x-large>
        <v-icon @click.stop="themeForm" color="grey lighten-1">mdi-plus-circle</v-icon>
      </v-btn>
    </v-list-item>
    <v-divider></v-divider>
    <v-list two-line subheader>
      <template v-for="(theme, index) in themes">
        <v-list-item :key="'theme'+theme.id" @click.stop>
          <v-list-item-avatar>
            <v-icon :class="['blue white--text']">mdi-view-module</v-icon>
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title v-text="theme.title"></v-list-item-title>
            <v-list-item-subtitle v-text="theme.description"></v-list-item-subtitle>
            <div class="inline" v-if="theme.theme_leaders.length">
              <span>
                <i>Theme Leaders:</i>
              </span>
              <v-chip class="my-1 mx-1" v-for="themeLeader in theme.theme_leaders" :key="themeLeader.id">
                <v-avatar left>
                  <v-icon>mdi-account-circle</v-icon>
                </v-avatar>
                {{themeLeader.user.name}}
              </v-chip>
            </div>
          </v-list-item-content>
          <v-list-item-action>
            <v-btn icon>
              <v-icon @click.stop="deleteTheme(theme.id)" color="grey lighten-1">mdi-delete</v-icon>
            </v-btn>
          </v-list-item-action>
        </v-list-item>
        <v-divider v-if="index + 1 < conference.themes.length" :key="index"></v-divider>
      </template>
    </v-list>
  </v-col>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {};
  },

  methods: {
    ...mapActions({
      deleteTheme: "themes/deleteTheme"
    }),

    themeForm() {
      this.$emit("themeForm");
    }
  },

  computed: {
    ...mapGetters({
      conference: "conferences/getConference",
      themes: "themes/getThemes"
    })
  }
};
</script>
<style scoped>
.no-uppercase {
  text-transform: none;
  letter-spacing: normal;
}

@media (max-width: 768px) {
  .md-full-width {
    width: 100%;
  }
}
</style>
