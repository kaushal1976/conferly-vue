<template>
  <div>
    <v-dialog v-model="showLeaderForm" persistent max-width="600px">
      <v-card>
        <v-card-title>
          <span class="headline">Theme Leader</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-form v-model="valid" ref="themeLeaderForm" @submit.stop.prevent class="py-0">
              <v-row class="justify-center my-2">
                <v-col cols="12" class="py-1">
                  <v-text-field
                    label="Enter the email of the Theme Leader"
                    v-model="theme.themeLeader.user.email"
                    :rounded="rounded"
                    :dense="dense"
                    :rules="emailRules"
                    :error-messages="asyncErrors.email"
                    outlined
                    required
                    @input="asyncErrors=''"
                    :disabled="searchCompleted"
                  >
                  </v-text-field>
                </v-col>
              <template v-if="searchCompleted && !userFound">
                <v-col cols="12" md="3" class="py-1">
                  <v-select
                    label="Title"
                    :items = "titles"
                    v-model="theme.themeLeader.user.title"
                    :rounded="rounded"
                    :dense="dense"
                    :error-messages="asyncErrors['user.title']"
                    outlined
                    @input="asyncErrors=''"
                  ></v-select>
                </v-col>
                <v-col cols="12" md="4" class="py-1">
                  <v-text-field
                    label="First Name"
                    v-model="theme.themeLeader.user.firstName"
                    :rounded="rounded"
                    :dense="dense"
                    :rules="firstNameRules"
                    :error-messages="asyncErrors['user.firstName']"
                    outlined
                    required
                    @input="asyncErrors=''"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" md="5" class="py-1">
                  <v-text-field
                    label="Surname"
                    v-model="theme.themeLeader.user.surname"
                    :rounded="rounded"
                    :dense="dense"
                    :rules="surnameRules"
                    :error-messages="asyncErrors['user.surname']"
                    outlined
                    required
                    @input="asyncErrors=''"
                  ></v-text-field>
                </v-col>
                </template>
                <template v-if="searchCompleted && userFound">
                  <h3>User: {{theme.themeLeader.user.name}}</h3>
                </template>
                <v-col cols="12" class="py-0">
                  <v-divider class="my-4"></v-divider>
                  <v-btn
                    v-if="searchCompleted"
                    @click.stop="setThemeLeader()"
                    :class="{ 'blue darken-4 white--text' : valid, disabled: !valid }"
                    class="no-uppercase"
                    :rounded="rounded"
                    :dense="dense"
                    :large="btnLarge"
                    outlined
                  >Add</v-btn>
                  <v-btn
                    v-if="!searchCompleted"
                    class="blue darken-4 white--text no-uppercase"
                    :rounded="rounded"
                    :dense="dense"
                    :large="btnLarge"
                    outlined
                    elevation="0"
                    @click.stop="findUser"
                  >Search</v-btn>
                  <v-btn
                    @click.stop="modalToggle"
                    class="blue darken-4 white--text no-uppercase"
                    :rounded="rounded"
                    :dense="dense"
                    :large="btnLarge"
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
export default {
  data() {
    return {
      rounded:false,
      dense:false,
      btnLarge:true,
      asyncErrors: [],
      valid: false,
      emailRules: [
        v => !!v || "Email is required",
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
        ],
      firstNameRules: [v => !!v || "First name is required"],
      surnameRules: [v => !!v || "Surname is required"],
      userFound:false,
      searchCompleted: false,
      titles:['Dr', 'Prof', 'Mr', 'Mrs', 'Miss', 'Ms']
    };
  },
  props: {
    showLeaderForm: Boolean
  },
  methods: {
    setThemeLeader() {
      if (this.$refs.themeLeaderForm.validate()) {
        let data = Object.assign({}, this.theme.themeLeader);
        this.$store
          .dispatch("themes/setThemeLeader", data)
          .then(response => {
            this.$refs.themeLeaderForm.reset();
            this.modalToggle();
          })
          .catch(error => {
            if (error.response.status === 422) {
              this.asyncErrors = error.response.data.errors;
            }else {
              console.log(error);
            }
          });
      }
    },
    modalToggle() {
      this.$refs.themeLeaderForm.reset();
      this.$emit("hide");
    },
    findUser() {
      if (this.themeLeaderExists(this.theme.themeLeader.user.email)) {
        this.asyncErrors = {'email':'This Theme Leader is already added'}
        return
      }
      if (this.$refs.themeLeaderForm.validate()) {
        let data = this.theme.themeLeader.user;
        this.$store
          .dispatch("themes/findUser", data)
          .then(response => {
            this.searchCompleted = true
            this.userFound = true
          })
          .catch(error => {
            if (error.response.status === 422) {
              this.asyncErrors = error.response.data.errors;
            } else if (error.response.status === 404) {
              this.searchCompleted = true
            } else {
              console.log(error);
            }
          });
      }
    }
  },
  computed: {
    ...mapGetters({
      theme: "themes/getTheme",
      themeLeaderExists: "themes/themeLeaderExists"
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