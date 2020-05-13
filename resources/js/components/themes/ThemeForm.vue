<template>
    <v-dialog v-model="showThemeForm" persistent max-width="800px">
      <v-card>
        <v-list-item>
          <v-list-item-avatar color="grey"></v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title class="headline">Theme</v-list-item-title>
            <v-list-item-subtitle>Add a new theme</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
        <v-card-text>
            <v-form v-model="valid" ref="themeForm" @submit.stop.prevent class="py-0 px-0">
              <v-row class="py-0" justify="center">
                <v-col cols="12" class="py-0">
                  <v-text-field
                    label="Enter a title for the Theme"
                    v-model="theme.title"
                    :rounded="rounded"
                    :dense="dense"
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
                    :rounded="rounded"
                    :dense="dense"
                    :rules="descriptionRules"
                    :error-messages="asyncErrors.description"
                    rows="5"
                    outlined
                    required
                    @input="asyncErrors=''"
                  ></v-textarea>
                </v-col>
                <v-col cols="12" class="py-0">
                  <template v-if="theme.themeLeaders.length">
                    <v-chip
                    v-for="(leader,index) in theme.themeLeaders"
                    :key="index"
                    :large="chipLarge"
                    class="ma-2"
                    close
                    @click:close="removeLeader(leader)"
                  >
                  <v-avatar left>
                    <v-icon>mdi-account-circle</v-icon>
                  </v-avatar>
                  {{leader.user.title+' '+leader.user.firstName+' '+leader.user.surname}}
                  </v-chip>
                  </template>
                </v-col>
                <v-col cols="12" class="py-0">
                  <ThemeLeader v-if="themeLeaderModal" 
                    :showLeaderForm="themeLeaderModal" 
                    @hide="showLeaderFormToggle">
                  </ThemeLeader>
                  <v-btn
                    class="no-uppercase my-3"
                    color="primary"
                    elevation="0"
                    @click.stop="showLeaderFormToggle"
                  >
                    Add a theme Leader
                    <v-icon dark>mdi-plus</v-icon>
                  </v-btn>
                </v-col>
                <v-col cols="12" class="py-0">
                  <v-divider class="my-4"></v-divider>
                  <v-btn
                    @click.stop="setTheme(conference.id)"
                    color="primary"
                    class="no-uppercase"
                    :rounded="rounded"
                    :dense="dense"
                    :large="btnLarge"
                    :disabled="((!valid)||(!theme.themeLeaders.length  > 0))"
                    :elevation="0"
                  >Add</v-btn>
                  <v-btn
                    @click.stop="hide"
                    class="no-uppercase"
                    color="primary"
                    :rounded="rounded"
                    :dense="dense"
                    :large="btnLarge"
                    :elevation="0"
                  >Cancel</v-btn>
                </v-col>
              </v-row>
            </v-form>
        </v-card-text>
      </v-card>
    </v-dialog>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import ThemeLeader from "../theme-leaders/ThemeLeader";
export default {
  data() {
    return {
      asyncErrors: [],
      valid: false,
      titleRules: [v => !!v || "Title is required"],
      descriptionRules: [v => !!v || "Description is required"],
      themeLeaderModal: false,
      rounded:false,
      dense:false,
      btnLarge:true,
      chipLarge:false
    };
  },
  props: {
    showThemeForm: Boolean
  },

  methods: {
    setTheme(conferenceId) {
      if (this.$refs.themeForm.validate()) {
        let data = Object.assign({}, this.theme);
        data.conferenceId = conferenceId;
        this.$store
          .dispatch("themes/setTheme", data)
          .then(response => {
            this.$refs.themeForm.reset();
            this.hide();
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
    removeLeader(leader) {
      this.$store.dispatch("themes/deleteThemeLeader", leader)

    },
    hide() {
      this.$refs.themeForm.reset();
      this.$emit("cancelled");
    },

    showLeaderFormToggle() {
      this.themeLeaderModal = !this.themeLeaderModal;
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
