<template>
  <v-row class="justify-center">
    <v-col :sm="12" :md="10" class="pb-6">
      <v-card class="px-5 py-6" :outlined="true">
        <v-card-title>Themes for {{conference.title}}</v-card-title>
        <v-card-text>
          You can add themes to your conference here. Each theme can have multiple theme
          leaders who are responsible for managing the reviews, etc.
        </v-card-text>
        <v-row class="justify-center py-0 px-5">
          <v-col cols="12">
            <v-btn
              class="no-uppercase my-2 px-6"
              color="primary"
              elevation="0"
              @click="showToggle"
              fab
            > <v-icon dark>mdi-plus</v-icon>
            </v-btn>
            <v-divider class="my-4"></v-divider>
          </v-col>
          <v-col cols="12" v-if="show==true">
            <ThemeForm @cancelled="showToggle"></ThemeForm>
          </v-col>
          <v-col cols="12" class="py-0">
            <Themes></Themes>
          </v-col>
          <v-col cols="12" class="py-0">
            <v-divider class="my-4"></v-divider>
            <v-card-actions>
              <v-btn
                @click="previous"
                :class="{ 'blue darken-4 white--text' : valid, disabled: !valid }"
                class="no-uppercase"
                :dense='true'
                outlined
              >Previous</v-btn>
              <v-btn
                :class="{ 'blue darken-4 white--text no-uppercase' : valid, disabled: !valid }"
                class="no-uppercase"
                @click="complete"
                :dense="true"
                outlined
              >Next</v-btn>
            </v-card-actions>
          </v-col>
        </v-row>
      </v-card>
    </v-col>
  </v-row>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import Themes from "../themes/Themes";
import ThemeForm from "../themes/ThemeForm";
export default {
  components: {
    Themes,
    ThemeForm
  },
  data() {
    return {
      asyncErrors: [],
      test:false,
      valid: false,
      titleRules: [v => !!v || "Title is required"],
      descriptionRules: [v => !!v || "Description is required"],
      show: false
    };
  },

  methods: {
    ...mapActions({
      fetchThemes: "themes/fetchThemes",
      deleteTheme: "themes/deleteTheme"
    }),

    previous() {
      this.$emit("previous");
    },

    showToggle() {
      this.show = !this.show;
    },

    complete() {
      this.$emit("complete");
    }
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
