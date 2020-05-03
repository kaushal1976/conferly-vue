<template>
  <div>
    <v-row class="justify-center mx-1" v-if="themes">
        <v-col class="pb-2" :sm="12" v-for="theme in themes" justify="center" :key="theme.id">
          <v-card class="my-0 grey lighten-4" :elevation="0" :outlined="true">
            <v-card-title>{{theme.title}}</v-card-title>
            <v-card-text>
              <v-row align="center" class="mx-0">
                <v-rating :value="4.5" color="amber" dense half-increments size="25"></v-rating>
                <div class="grey--text ml-4">4.5 (413)</div>
              </v-row>
              <div class="my-4 subtitle-1">{{theme.description}}</div>
            </v-card-text>
            <v-divider class="mx-4"></v-divider>
            <v-card-actions>
              <v-btn 
              color="deep-purple lighten-2" 
              text
              class="no-uppercase"
              >Reserve</v-btn>
              <v-btn @click="deleteTheme(theme.id)" 
              color="deep-purple lighten-2" 
              text
              class="no-uppercase"
              >Remove</v-btn>
              <v-btn
                :to="{ name: 'edit-theme', params: { themeId: theme.id }}"
                color="deep-purple lighten-2"
                class="no-uppercase"
                text
              >Edit</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
    </v-row>
  </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
methods: {
    ...mapActions({
      fetchThemes: "themes/fetchThemes",
      deleteTheme: "themes/deleteTheme"
    })
  },

computed: {
    ...mapGetters({
      conference: "conferences/getConference",
      themes: "themes/getThemes",
      theme: "themes/getTheme"
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