<template>
  <v-row class="justify-center">
    <v-col :sm="12" :md="10" class="pb-6">
      <v-card class="px-5 py-6" :outlined="true">
        <v-card-title>Conference Details</v-card-title>
        <v-form v-model="valid" ref="conferenceForm" @submit.stop.prevent class="py-0">
          <v-row class="justify-center py-0 px-5">
            <v-col cols="12">
              <v-text-field
                label="Enter a title for the Conference"
                v-model="conference.title"
                :dense="true"
                :rules="titleRules"
                :error-messages="asyncErrors.title"
                outlined
                required
                @input="asyncErrors=''"
              ></v-text-field>
              <v-text-field
                label="Enter a Tag Line for the Conference"
                v-model="conference.tag_line"
                :dense="true"
                :rules="tagLineRules"
                :error-messages="asyncErrors.tag_line"
                outlined
                required
                @input="asyncErrors=''"
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" justify="center" class="py-0">
              <v-menu
                v-model="sDateMenu"
                :close-on-content-click="false"
                :nudge-right="40"
                transition="scale-transition"
                offset-y
                min-width="290px"
              >
                <template v-slot:activator="{ on }">
                  <v-text-field
                    v-model="conference.start_date"
                    :dense="true"
                    label="Start Date"
                    append-icon="mdi-calendar"
                    :rules="dateRules"
                    :error-messages="asyncErrors.start_date"
                    outlined
                    readonly
                    v-on="on"
                  ></v-text-field>
                </template>
                <v-date-picker v-model="conference.start_date" @change="sDateChanged"></v-date-picker>
              </v-menu>
            </v-col>
            <v-col cols="12" sm="6" justify="center" class="py-0">
              <v-menu
                v-model="fDateMenu"
                :close-on-content-click="false"
                :nudge-right="40"
                transition="scale-transition"
                offset-y
                min-width="290px"
              >
                <template v-slot:activator="{ on }">
                  <v-text-field
                    v-model="conference.end_date"
                    :dense="true"
                    label="End Date"
                    append-icon="mdi-calendar"
                    :rules="dateRules"
                    :error-messages="asyncErrors.end_date"
                    outlined
                    readonly
                    v-on="on"
                    :disabled="fDateDisabled"
                  ></v-text-field>
                </template>
                <v-date-picker
                  v-model="conference.end_date"
                  @change="fDateMenu = false"
                  :min="minDate"
                ></v-date-picker>
              </v-menu>
            </v-col>
            <v-col cols="12">
              <v-text-field
                label="Enter the venue of the Conference"
                v-model="conference.venue"
                :dense="true"
                :rules="venueRules"
                :error-messages="asyncErrors.venue"
                outlined
                required
                @input="asyncErrors=''"
              ></v-text-field>
              <v-text-field
                label="Enter Subject Area the Conference"
                v-model="conference.subject_area"
                :dense="true"
                :rules="subjectRules"
                :error-messages="asyncErrors.subject_area"
                outlined
                required
                @input="asyncErrors=''"
              ></v-text-field>
            </v-col>
            <v-col cols="12" class="py-0">
              <v-textarea
                label="A description for the Conference"
                :dense="true"
                v-model="conference.description"
                rows="5"
                :rules="descriptionRules"
                :error-messages="asyncErrors.description"
                outlined
                required
                @input="asyncErrors=''"
              ></v-textarea>
            </v-col>
            <v-col cols="12" class="py-0">
              <v-divider></v-divider>
              <v-card-actions>
                <v-btn
                  @click="setConference"
                  :class="{ 'blue darken-4 white--text' : valid, disabled: !valid }"
                  :dense="true"
                  outlined
                  class="no-uppercase"
                >Next</v-btn>
              </v-card-actions>
            </v-col>
          </v-row>
        </v-form>
      </v-card>
    </v-col>
  </v-row>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      valid: false,
      asyncErrors: [],
      tagLineRules: [v => !!v || "Tag line is required"],
      titleRules: [v => !!v || "Title is required"],
      dateRules: [v => !!v || "Please check the date"],
      descriptionRules: [v => !!v || "Description is required"],
      venueRules: [v => !!v || "Venue is required"],
      subjectRules: [v => !!v || "Subject is required"],
      fDateDisabled: true,
      sDateMenu: false,
      fDateMenu: false
    };
  },

  methods: {
    ...mapActions({
      fetchConferences: "conferences/fetchConferences",
      fetchConference: "conferences/fetchConference",
      deleteConference: "conferences/deleteConference"
    }),
    setConference() {
      if (this.$refs.conferenceForm.validate()) {
        let data = Object.assign({}, this.conference);
        this.$store
          .dispatch("conferences/setConference", data)
          .then(response => {
            this.$emit("complete");
          })
          .catch(error => {
            this.asyncErrors = error.response.data.errors;
          });
      }
    },
    sDateChanged() {
      this.fDateDisabled = false;
      this.sDateMenu = false;
      if (
        new Date(this.conference.start_date).getTime() >=
        new Date(this.conference.end_date).getTime()
      ) {
        this.conference.end_date = this.conference.start_date;
      }
    }
  },
  mounted() {
    this.fetchConference(this.$route.params.conferenceId);
  },
  computed: {
    minDate() {
      return this.conference.start_date;
    },
    ...mapGetters({
      conference: "conferences/getConference"
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