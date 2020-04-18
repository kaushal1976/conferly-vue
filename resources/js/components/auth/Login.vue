<template>
  <v-layout align-center justify-center>
    <v-flex xs12 sm8 md6>
      <v-toolbar class="pt-5 grey darken-4">
        <v-toolbar-items>
          <v-toolbar-title class="white--text">
            <h4>Welcome Back</h4>
          </v-toolbar-title>
        </v-toolbar-items>
      </v-toolbar>
      <v-card>
        <v-card-text class="pt-4">
          <v-form v-model="valid" ref="form" @submit.prevent>
            <v-text-field
              label="Enter your e-mail address"
              v-model="test.email"
              :rules="emailRules"
              :error-messages="manualErrors.email"
              outlined
              required
            ></v-text-field>
            <v-text-field
              label="Enter your password"
              v-model="test.password"
              min="8"
              :append-icon="e1 ? 'mdi-eye' : 'mdi-eye-off'"
              @click:append="() => (e1 = !e1)"
              :type="e1 ? 'password' : 'text'"
              :rules="passwordRules"
              outlined
              required
            ></v-text-field>
            <v-layout justify-space-between>
              <v-btn
                @click.prevent="testPost()"
                :class="{ 'blue darken-4 white--text' : valid, disabled: !valid }"
                outlined
              >Login</v-btn>
              <a href>Forgot Password</a>
            </v-layout>
          </v-form>
        </v-card-text>
      </v-card>
    </v-flex>
  </v-layout>
</template>
<style scoped>
</style>
<script>
import axios from "axios";
export default {
  data() {
    return {
      test: {},
      valid: false,
      e1: false,
      manualErrors: [],
      passwordRules: [v => !!v || "Password is required"],
      emailRules: [
        v => !!v || "E-mail is required",
      ]
    };
  },
  methods: {
    testPost() {
      if (this.$refs.form.validate()) {
        axios
          .post("/api/test", this.test)
          .then(response => {
            this.manualErrors = [];
            console.log(JSON.stringify(response));
          })
          .catch(error => {
            this.manualErrors = error.response.data.errors;
            console.log(this.manualError.email)
          });
      }
    },
    clear() {
      this.$refs.form.reset();
    },
    addConference: function(test) {
      this.$refs.form.validate();
      this.$store.dispatch("addConference", { ...this.test });
    }
  },
  computed: {}
};
</script>
