<template>
  <v-row class="justify-center">
    <v-col :sm="12" :md="10" class="pb-6">
      <v-card class="py-6" :outlined="true">
        <div class="px-4">
          <v-card-title>Themes for {{conference.title}}</v-card-title>
          <v-card-text>
            You can add themes to your conference here. Each theme can have multiple theme
            leaders who are responsible for managing the reviews, etc.
          </v-card-text>
          <v-col cols="12">
            <v-btn
              v-if="show==false"
              class="no-uppercase my-2 px-6 md-full-width"
              color="primary"
              elevation="0"
              @click="show = !show"
            >Add a theme</v-btn>
          </v-col>
        </div>

        <v-divider class="my-4"></v-divider>
        <v-form v-model="valid" ref="themeForm" @submit.stop.prevent class="py-0">
          <v-row class="justify-center py-0 px-5">
            <template v-if="show">
              <v-col cols="12">
                <v-text-field
                  label="Enter a title for the Theme"
                  v-model="theme.title"
                  :dense="true"
                  :rules="titleRules"
                  :error-messages="asyncErrors.title"
                  outlined
                  required
                  @input="asyncErrors=''"
                ></v-text-field>
              </v-col>
              <v-col cols="12" class="py-0">
                <v-textarea
                  label="A description for the Theme"
                  v-model="theme.description"
                  :dense="true"
                  :rules="descriptionRules"
                  :error-messages="asyncErrors.description"
                  rows="5"
                  outlined
                  required
                  @input="asyncErrors=''"
                ></v-textarea>
              </v-col>
              <v-col cols="12" class="py-0">
                <v-btn
                  @click="setTheme(conference.id)"
                  :class="{ 'blue darken-4 white--text' : valid, disabled: !valid }"
                  :dense="true"
                  outlined
                  large
                >Add</v-btn>
                <v-btn
                  @click="show=!show"
                  class="blue arken-4 white--text"
                  :dense="true"
                  outlined
                  large
                >Cancel</v-btn>
                <v-divider class="my-4"></v-divider>
              </v-col>
            </template>
            <v-col cols="12" class="py-0">
              <Themes></Themes>
            </v-col>
            <v-col cols="12" class="py-0">
              <v-divider class="my-4"></v-divider>
              <v-btn
                :class="{ 'blue darken-4 white--text no-uppercase' : valid, disabled: !valid }"
                @click="complete"
                :dense="true"
                outlined
                large
              >Next</v-btn>
            </v-col>
          </v-row>
        </v-form>
      </v-card>
    </v-col>
  </v-row>
</template>
<style scoped>
</style>
<script>
import { mapActions, mapGetters } from "vuex";
import Themes from "../themes/Themes";
export default {
  components: {
    Themes
  },
  data() {
    return {
      asyncErrors: [],
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
    setTheme(conferenceId) {
      if (this.$refs.themeForm.validate()) {
        let data = Object.assign({}, this.theme);
        data.conferenceId = conferenceId;
        this.$store
          .dispatch("themes/setTheme", data)
          .then(response => {
            this.show = false;
          })
          .catch(error => {
            if (error.response.status === 422) {
              this.asyncErrors = error.response.data.errors;
            } else {
              console.log(error);
            }
          });
      }
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
