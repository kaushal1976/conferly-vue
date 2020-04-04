<template>
<v-layout class="align-top">
<v-stepper v-model="e1" class="elevation-0 flex py-0">
    <v-stepper-header class="elevation-0 py-0">
      <v-stepper-step :complete="e1 > 1" step="1">Initial Details</v-stepper-step>
      <v-divider></v-divider>
      <v-stepper-step :complete="e1 > 2" step="2">Themes</v-stepper-step>
      <v-divider></v-divider>
      <v-stepper-step step="3">Theme Leaders</v-stepper-step>
    </v-stepper-header>
    <v-stepper-content
            :key="`1-content`"
            :step="1"
            class="py-0"
          >
           <Step1/>
    </v-stepper-content>
  </v-stepper>

  
</v-layout>
</template>

<style scoped>

</style>
<script>
import axios from "axios"
import Step1 from './Step1.vue'
export default {
  data() {
    return {
      conference: {},
      valid: false,
      e1: 1,
      titleRules: [v => !!v || "Title is required"],
      locationRules: [v => !!v || "Location is required"],
      tagLineRules: [v => !!v || "Tag Line is required"],
      dates: ["2019-09-10", "2019-09-20"],
      modal: false
    };
  },
  methods: {
    testPost() {
      if (this.$refs.form.validate()) {
        axios
          .post("/api/test", this.test)
          .then(response => {
            console.log(JSON.stringify(response));
          })
          .catch(error => {
            console.log(JSON.stringify(error));
          });
      }
    },
    clear() {
      this.$refs.form.reset();
    },
    addConference: function(test) {
      this.$store.dispatch("addConference", { ...this.test });
    }
  },
  computed: {
    dateRangeText() {
      return this.dates.join(" ~ ");
    }
  },
  components: {
    Step1,
  }
};
</script>
