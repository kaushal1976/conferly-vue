<template>
  <div>
      <v-btn
        class="no-uppercase"
        color="primary"
        elevation="0"
        @click="modalToggle"
        fab
      >
        <v-icon dark>mdi-plus</v-icon>
      </v-btn>
    <v-dialog v-model="themeLeaderModal" max-width="600px">
      <v-card>
        <v-card-title>
          <span class="headline">Theme Leader</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row class="justify-center my-2">
              <v-col cols="12" class="py-1">
                <v-text-field
                  label="Enter the email of the Theme Leader"
                  v-model="themeLeader.email"
                  :dense="true"
                  :rules="emailRules"
                  :error-messages="asyncErrors.title"
                  outlined
                  required
                  @input="asyncErrors=''"
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="2" class="py-1">
                <v-text-field
                  label="Title"
                  v-model="themeLeader.title"
                  :dense="true"
                  :rules="titleRules"
                  :error-messages="asyncErrors.title"
                  outlined
                  required
                  @input="asyncErrors=''"
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="5" class="py-1">
                <v-text-field
                  label="First Name"
                  v-model="themeLeader.firstName"
                  :dense="true"
                  :rules="firstNameRules"
                  :error-messages="asyncErrors.name"
                  outlined
                  required
                  @input="asyncErrors=''"
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="5" class="py-1">
                <v-text-field
                  label="Surname"
                  v-model="themeLeader.surname"
                  :dense="true"
                  :rules="surnameRules"
                  :error-messages="asyncErrors.name"
                  outlined
                  required
                  @input="asyncErrors=''"
                ></v-text-field>
              </v-col>
              <v-col cols="12" class="py-0">
                <v-divider class="my-4"></v-divider>
                <v-btn
                  @click="setThemeLeader()"
                  :class="{ 'blue darken-4 white--text' : valid, disabled: !valid }"
                  class="no-uppercase"
                  :dense="true"
                  outlined
                >Add</v-btn>
                <v-btn class="blue arken-4 white--text no-uppercase" :dense="true" outlined>Cancel</v-btn>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      themeLeaderModal: false,
      themeLeader: {},
      asyncErrors: [],
      valid: false,
      emailRules: [v => !!v || "Email is required"],
      titleRules: [v => !!v || "Title is required"],
      firstNameRules: [v => !!v || "First name is required"],
      surnameRules: [v => !!v || "Surname is required"]
    };
  },

  methods: {
    setThemeLeader() {
      if (this.$refs.themeLeaderForm.validate()) {
        let data = Object.assign({}, this.themeLeader);
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
    modalToggle() {
      this.themeLeaderModal = !this.themeLeaderModal;
    }
  },
  computed: {
    ...mapGetters({
      //themeLeader: "themes/getThemeLeader"
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