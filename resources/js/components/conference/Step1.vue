<template>
<v-row class="justify-center">
  <v-col 
  :sm="12"
  :md="10"
  class="pb-6"
  >
  <v-card class="px-5 py-6" :outlined="true">
    <v-card-title>Conference Details</v-card-title>
    <v-form v-model="valid" ref="conferenceForm" @submit.stop.prevent class="py-0">
      <v-row class="justify-center py-0 px-5">
          <v-col cols="12">
          <v-text-field
            label="Enter a title for the Conference"
            v-model="conference.title"
            :dense='true'
            :rules="titleRules"
            :error-messages="asyncErrors.title"
            outlined
            required
            @input="asyncErrors=''"
          ></v-text-field>
          <v-text-field
            label="Enter a Tag Line for the Conference"
            v-model="conference.tag_line"
            :dense='true'
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
                :dense='true'
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
                :dense='true'
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
            <v-date-picker v-model="conference.end_date" @change="fDateMenu = false" :min="minDate"></v-date-picker>
          </v-menu>
        </v-col>
        <v-col cols="12">
          <v-text-field
            label="Enter the venue of the Conference"
            v-model="conference.venue"
            :dense='true'
            :rules="venueRules"
            :error-messages="asyncErrors.venue"
            outlined
            required
            @input="asyncErrors=''"
          ></v-text-field>
          <v-text-field
            label="Enter Subject Area the Conference"
            v-model="conference.subject_area"
            :dense='true'
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
            :dense='true'
            v-model="conference.description"
            rows="5"
            :rules="descriptionRules"
            :error-messages="asyncErrors.description"
            outlined
            required
            @input="asyncErrors=''"
          ></v-textarea>
        </v-col>
        <v-col cols="12">
          <VueFileAgent 
          ref="vueFileAgent"
          :theme="'list'"
          :dense='true'
          @delete="deleteUploadedFile($event)"
          @upload="onUpload($event)"
          @upload:error="onUploadError($event)"
          :uploadUrl="uploadUrl" 
          v-model="fileRecords"
          :deletable="false"
          :multiple="false"
          ></VueFileAgent>
        </v-col>
        <v-col cols="12" class="py-0">
          <v-btn
            @click="addConference"
            :class="{ 'blue darken-4 white--text' : valid, disabled: !valid }"
            :dense='true'
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
import ConferenceImage from './ConferenceImage.vue'
import { mapActions } from "vuex";
export default {
  components: {
    ConferenceImage
  },
  data() {
    return {
      uploadUrl: "/api/conference/image/",
      fileRecordsForUpload: [],
      fileRecords: [],
      conference: {},
      asyncErrors: [],
      valid: false,
      tagLineRules: [v => !!v || "Tag line is required"],
      titleRules: [v => !!v || "Title is required"],
      dateRules: [
        v =>
          !this.fDateDisabled ||
          "Please check Start and End dates of the Conference"
      ],
      descriptionRules: [v => !!v || "Description is required"],
      venueRules: [v => !!v || "Venue is required"],
      subjectRules: [v => !!v || "Subject is required"],
      imageRules: [value => !!value || "Please select a background image"],
      start_date: new Date().toISOString().substr(0, 10),
      end_date: new Date().toISOString().substr(0, 10),
      fDateDisabled: true,
      sDateMenu: false,
      fDateMenu: false,
      modal: false 
    };
  },

  methods: {
    addConference() {
      if (this.$refs.conferenceForm.validate()) { 
        this.$store
          .dispatch("addConference", { ...this.conference })
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
    },
    fetchConference() {
      if (this.$route.params.id) {
        (this.loading = true),
          this.$store
            .dispatch("fetchConference", (this.id = this.$route.params.id))
            .then(response => {
              this.loading = false;
              this.fDateDisabled = false;
              this.conference = this.$store.state.conference;
              this.conference.start_date = new Date(this.conference.start_date)
                .toISOString()
                .substr(0, 10);
              this.conference.end_date = new Date(this.conference.end_date)
                .toISOString()
                .substr(0, 10);
            });
      }
    },
    deleteUploadedFile: function(fileRecord) {
      // Using the default uploader. You may use another uploader instead
      let uploadUrl = this.uploadUrl+fileRecord.upload.data.id
      let uploadedData={
         id: fileRecord.upload.data.id,
         data: fileRecord.upload.data
       }
      this.uploadUrl = uploadUrl

      this.$refs.vueFileAgent.deleteUpload(this.uploadUrl, this.uploadHeaders, uploadedData, [fileRecord]);

    },
  
    onUploadDeleteError(failedResponse) {
          //console.log("Test"+JSON.stringify(failedResponse));
    },
    onUploadDelete(Response) {
          //console.log("Test"+JSON.stringify(Response));
    },
    onUpload(responses) {
      //let files = Array.isArray(responses) ? responses : [responses]
      //for (let file of files) {
        /*console.log(file)
        //var backendObj = respObj.result.files.file[0]
        //let fileRecord = file.data.fil
        let index = this.fileRecords.indexOf(file)

        this.fileRecords[index] = {
          name: file.name,
          size: file.size,
          type: file.type,
          ext: file.ext,
          progress: 100,
        }
      */
      //this.fileRecords = this.fileRecords.slice() // trigger vue change
      //console.log(this.fileRecords)
    },
      
    onUploadError(failedResponses) {
        //console.log(JSON.stringify(failedResponse))
    }

  },
  mounted() {
    this.fetchConference();
  },
  computed: {
    minDate() {
      return this.conference.start_date;
    }
  }
};
</script>
