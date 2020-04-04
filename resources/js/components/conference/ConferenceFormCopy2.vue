<template>
  <v-card
          class="mb-12"
          color="grey lighten-1"
          height="200px"
        >
        
        </v-card>
</template>
<style scoped>

</style>
<script>
import axios from "axios";
export default {
  data() {
    return {
      conference: {},
      valid: false,
      e1: false,
      titleRules: [v => !!v || "Title is required"],
      locationRules: [v => !!v || "Location is required"],
      tagLineRules: [v => !!v || "Tag Line is required"],
      dates: ["2019-09-10", "2019-09-20"],
      menu: false,
      modal: false,
      e1: 1
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
      return this.dates.join(" To ");
    }
  }
};
</script>
