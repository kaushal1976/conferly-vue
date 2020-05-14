<template>
<v-container fluid fill-height class="px-0 py-0">
  <v-row class="fill-height mx-0">
      <v-stepper v-model="e1" class="elevation-0 flex py-0 grey lighten-3">
      <v-stepper-header class="elevation-0 py-0 white">
        <v-stepper-step :complete="e1 > 1" step="1"> Conference Details</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step :complete="e1 > 2" step="2">Add Themes</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step :complete="e1 > 3" step="3">Summary</v-stepper-step>
      </v-stepper-header>
      <v-stepper-items>
        <v-stepper-content :key="`1-content`" :step="1" class="py-0">
          <Step1 @complete="nextStep" />
        </v-stepper-content>
        <v-stepper-content :key="`2-content`" :step="2" class="py-0">
          <Step2 @complete="nextStep" @previous="previousStep" />
        </v-stepper-content>
        <v-stepper-content :key="`3-content`" :step="3" class="py-0">
          <Conference @complete="home" @previous="previousStep" />
        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>
  </v-row>
  </v-container>
</template>
<style scoped>
</style>
<script>
import Step1 from "./Step1.vue";
import Step2 from "./Step2.vue";
import Conference from './Conference.vue'

export default {
  data() {
    return {
      e1: 1
    };
  },
  methods: {
    nextStep() {
      this.e1++;
    },
    previousStep() {
      this.e1--;
    },
    home() {
        this.$router.push({name:'conferences'})
    }
  },
  components: {
    Step1,
    Step2,
    Conference
  }
};
</script>
