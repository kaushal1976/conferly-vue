<template>
  <div>
    <v-dialog v-model="themeModal" max-width="800px">
      <v-card>
        <v-list-item>
          <v-list-item-avatar color="grey"></v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title class="headline">Theme</v-list-item-title>
            <v-list-item-subtitle>Add a new theme</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
        <v-card-text>
          <v-container>
            <v-form v-model="valid" ref="themeForm" @submit.stop.prevent class="py-0">
              <v-row class="justify-center py-0 px-3">
                <v-col cols="12 py-0">
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
                  <ThemeLeader></ThemeLeader>
                </v-col>
                <v-col cols="12" class="py-0">
                  <v-divider class="my-4"></v-divider>
                  <v-btn
                    @click="setTheme(conference.id)"
                    :class="{ 'blue darken-4 white--text' : valid, disabled: !valid }"
                    class="no-uppercase"
                    :dense="true"
                    outlined
                  >Add</v-btn>
                  <v-btn
                    @click="hidden"
                    class="blue darken-4 white--text no-uppercase"
                    :dense="true"
                    outlined
                  >Cancel</v-btn>
                </v-col>
              </v-row>
            </v-form>
          </v-container>
        </v-card-text>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import ThemeLeader from "./ThemeLeader";
export default {
  data() {
    return {
      asyncErrors: [],
      valid: false,
      titleRules: [v => !!v || "Title is required"],
      descriptionRules: [v => !!v || "Description is required"],
      themeModal: true
    };
  },

  methods: {
    setTheme(conferenceId) {
      if (this.$refs.themeForm.validate()) {
        let data = Object.assign({}, this.theme);
        data.conferenceId = conferenceId;
        this.$store
          .dispatch("themes/setTheme", data)
          .then(response => {
            this.hidden();
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
    hidden() {
      this.$emit("cancelled");
    }
  },
  computed: {
    ...mapGetters({
      conference: "conferences/getConference",
      theme: "themes/getTheme"
    })
  },
  components: {
    ThemeLeader
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
