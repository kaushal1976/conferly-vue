<template>
  <v-row justify="center" align="start" class="fill-height">
    <v-col cols="12" lg="10" xl="7">
      <v-card class="px-5 py-6" :outlined="true">
        <v-list-item>
          <v-list-item-avatar color="grey"></v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title class="headline">Almost done...</v-list-item-title>
            <v-list-item-subtitle>
              Please check and edit if
              necessary...
            </v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
        <v-divider></v-divider>
        <v-card-text>
          <v-row align="center" class="mx-0">
            <v-rating :value="4.5" color="amber" dense half-increments size="25"></v-rating>
            <div class="grey--text ml-4">4.5 (413)</div>
          </v-row>
          <v-card-title>{{ conference.title }}</v-card-title>
          <div class="my-4 subtitle-1">
            <i>{{ conference.start_date }}</i>
            <b>To</b>
            <i>{{ conference.end_date }}</i>
          </div>
          <div>{{ conference.description }}</div>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-title>Themes</v-card-title>
        <v-card-text>
          <template v-for="(theme, index) in themes">
            <v-list-item :key="'theme' + theme.id" @click.stop="">
              <v-list-item-avatar>
                <v-icon :class="['blue white--text']">mdi-view-module</v-icon>
              </v-list-item-avatar>
              <v-list-item-content>
                <v-list-item-title v-text="theme.title"></v-list-item-title>
                <v-list-item-subtitle v-text="theme.description"></v-list-item-subtitle>
                <div class="inline">
                  <span>
                    <i>Theme Leaders:</i>
                  </span>
                  <v-chip
                    class="ma-2"
                    v-for="themeLeader in theme.theme_leaders"
                    :key="themeLeader.id"
                  >
                    <v-avatar left>
                      <v-icon>mdi-account-circle</v-icon>
                    </v-avatar>
                    {{ themeLeader.user.name }}
                  </v-chip>
                </div>
              </v-list-item-content>
              <v-list-item-action>
                <v-btn icon>
                  <v-icon @click.stop="deleteTheme(theme.id)" color="grey lighten-1">mdi-delete</v-icon>
                </v-btn>
              </v-list-item-action>
            </v-list-item>
            <v-divider v-if="index + 1 < themes.length" :key="index"></v-divider>
          </template>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-btn
            @click.stop="previous"
            class="no-uppercase"
            color="primary"
            :rounded="rounded"
            :dense="dense"
            :large="btnLarge"
            elevation="0"
          >Previous</v-btn>
          <v-btn
            class="no-uppercase"
            color="primary"
            @click.stop="complete"
            :rounded="rounded"
            :dense="dense"
            :large="btnLarge"
            elevation="0"
          >Finish</v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>
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
<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      rounded: false,
      dense: false,
      btnLarge: true
    };
  },
  methods: {
    previous() {
      this.$emit("previous");
    },
    complete() {
      this.$emit("complete");
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
