<template>
  <div>
    <h2>Conference Details</h2>
    <v-form v-model="valid" ref="conferenceForm" @submit.stop.prevent class="py-0">
      <v-row class="justify-center py-0 px-5">
        <v-col cols="12">
          <v-text-field
            label="Enter a title for the Conference"
            v-model="conference.title"
            :rules="titleRules"
            :error-messages="asyncErrors.title"
            outlined
            required
            @input="asyncErrors=''"
          ></v-text-field>
          <v-text-field
            label="Enter a Tag Line for the Conference"
            v-model="conference.tag_line"
            :rules="tagLineRules"
            :error-messages="asyncErrors.tag_line"
            outlined
            required
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
            :rules="venueRules"
            :error-messages="asyncErrors.venue"
            outlined
            required
          ></v-text-field>
          <v-text-field
            label="Enter Subject Area the Conference"
            v-model="conference.subject_area"
            :rules="subjectRules"
            :error-messages="asyncErrors.subject_area"
            outlined
            required
          ></v-text-field>
        </v-col>
        <v-col cols="12" class="py-0">
          <v-textarea
            label="A description for the Conference"
            v-model="conference.description"
            rows="5"
            :rules="descriptionRules"
            :error-messages="asyncErrors.description"
            outlined
            required
          ></v-textarea>
        </v-col>
        <v-col cols="12" class="py-0">
          <VueFileAgent
            ref="vueFileAgent"
            :theme="'list'"
            :multiple="true"
            :deletable="true"
            :meta="true"
            :accept="'image/*,.zip'"
            :maxSize="'10MB'"
            :maxFiles="14"
            :helpText="'Choose images or zip files'"
            :errorText="{
              type: 'Invalid file type. Only images or zip Allowed',
              size: 'Files should not exceed 10MB in size',
            }"
            @select="filesSelected($event)"
            @delete="fileDeleted($event)"
            v-model="fileRecords"
          ></VueFileAgent>
          <v-btn
            :disabled="!fileRecordsForUpload.length"
            @click="uploadFiles()"
          >Upload {{ fileRecordsForUpload.length }} files</v-btn>
        </v-col>
        <v-col cols="12" class="py-0">
          <v-btn
            @click="addConference"
            :class="{ 'blue darken-4 white--text' : valid, disabled: !valid }"
            outlined
            large
          >Next</v-btn>
        </v-col>
      </v-row>
    </v-form>
  </div>
</template>
<style scoped>
</style>
<script>
import { mapActions } from "vuex";
export default {
  data() {
    return {
      fileRecords: [],
      uploadUrl: "/api/files/store/",
      uploadHeaders: { "X-Test-Header": "vue-file-agent" },
      fileRecordsForUpload: [],
      conference: {},
      asyncErrors: [],
      valid: false,
      fileRecords: [],
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
    uploadFiles: function() {
        // Using the default uploader. You may use another uploader instead.
        let newFile = new FormData();
        newFile.append('file', this.fileRecordsForUpload[0].file)
        axios.post(this.uploadUrl,newFile, this.uploadHeaders);
        this.fileRecordsForUpload = [];
      },
    deleteUploadedFile: function(fileRecord) {
      // Using the default uploader. You may use another uploader instead.
      this.$refs.vueFileAgent.deleteUpload(
        this.uploadUrl,
        this.uploadHeaders,
        fileRecord
      );
    },
    filesSelected: function(fileRecordsNewlySelected) {
      var validFileRecords = fileRecordsNewlySelected.filter(
        fileRecord => !fileRecord.error
      );
      this.fileRecordsForUpload = this.fileRecordsForUpload.concat(
        validFileRecords
      );
    },
    fileDeleted: function(fileRecord) {
      var i = this.fileRecordsForUpload.indexOf(fileRecord);
      if (i !== -1) {
        this.fileRecordsForUpload.splice(i, 1);
      } else {
        this.deleteUploadedFile(fileRecord);
      }
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
