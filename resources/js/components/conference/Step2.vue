<template>
<v-row class="justify-center">
  <v-col 
  :sm="12"
  :md="10"
  class="pb-6"
  >
  <v-card class="px-5 py-6" :outlined="true">
    <v-card-title>Themes for {{conference.title}}</v-card-title>
    <v-card-text>You can add themes to your conference here. Each theme can have multiple theme 
        leaders who are responsible for managing the reviews, etc.</v-card-text>
    <v-form v-model="valid" ref="themeForm" @submit.stop.prevent class="py-0">
      <v-row class="justify-center py-0 px-5">
          <v-col cols="12">
          <v-text-field
            label="Enter a title for the Theme"
            v-model="theme.title"
            :dense='true'
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
            :dense='true'
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
            :dense='true'
            outlined
            large
          >Next</v-btn>
        </v-col>
      </v-row>
    </v-form>
  </v-card>
  </v-col>
  <Themes></Themes>
</v-row>
</template>
<style scoped>
</style>
<script>
import { mapActions, mapGetters } from "vuex";
import Themes from '../themes/Themes'
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
    };
  },

  methods: {
    ...mapActions({
      fetchThemes: 'themes/fetchThemes',
      deleteTheme: 'themes/deleteTheme'
    }),
    setTheme(conferenceId) {
      if (this.$refs.themeForm.validate()) { 
        let data = Object.assign({}, this.theme)
        data.conferenceId = conferenceId
        this.$store
          .dispatch("themes/setTheme", data)
          .then(response => {
            this.$emit("complete");
          })
          .catch(error => {
              if (error.response.status===422) {
                  this.asyncErrors = error.response.data.errors;
              }else{
                  console.log(error)
              }
                
          });
      }
    },
    
  },
  computed: {
    ...mapGetters({
      conference:'conferences/getConference',
      themes:'themes/getTheme',
      theme:'themes/getThemes',
    })
  }
};
</script>
