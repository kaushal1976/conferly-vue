<template>
  <v-row no-gutters class="fill-height">
    <v-col cols="12">
      <v-row align="center" justify="center" class="grey lighten-5">
        <v-col cols="12" class="px-5">
          <v-card color="grey lighten-2" class="px-5 py-5" flat>
            <h1 class="font-weight-light"><span>Confer<b>ly</b></span></h1>
            <p class="lead text-muted">
              Helping to manage academic conferences worldwide. Paper management process, Review process,
              Registrations and payments, managing parallel tracts and many more...
            </p>
            <p>
              <v-btn
                class="no-uppercase my-2 md-full-width"
                elevation="0"
                href="/conference/create"
                large
                color="primary"
              >
                Create a
                new Conference
              </v-btn>
              <v-btn
                class="no-uppercase my-2 md-full-width"
                elevation="0"
                href="/conference"
                large
                color="primary"
              >Search Conferences</v-btn>
            </p>
          </v-card>
        </v-col>
        <v-responsive v-if="loading" class="p-3">
          <div class="p-3">
            <v-skeleton-loader type="list-item-avatar-three-line"></v-skeleton-loader>
          </div>
        </v-responsive>
        <v-row justify="center" v-if="conferences.length">
          <div class="d-flex" v-for="conference in conferences" justify="center" :key="conference.id">
            <v-col class="mx-2 d-flex flex-column">
              <v-card class="my-2 flex" max-width="374">
                <v-img height="250" :src='"/storage/conference/images/"+conference.image'></v-img>
                <v-card-title>{{conference.title}}</v-card-title>
                <v-card-text>
                  <v-row align="center" class="mx-0">
                    <v-rating :value="4.5" color="amber" dense half-increments size="25"></v-rating>
                    <div class="grey--text ml-4">4.5 (413)</div>
                  </v-row>
                  <div class="my-4 subtitle-1">
                    <i>{{conference.start_date | moment("dddd, MMMM Do YYYY")}}</i>
                    <b>To</b>
                    <i>{{conference.end_date | moment("dddd, MMMM Do YYYY")}}</i>
                  </div>
                  <div>{{conference.description}}</div>
                </v-card-text>
                <v-divider class="mx-4"></v-divider>
                <v-card-title>Tonight's availability</v-card-title>
                <v-card-text>
                  <v-chip-group active-class="deep-purple accent-4 white--text" column>
                    <v-chip>5:30PM</v-chip>
                    <v-chip>7:30PM</v-chip>
                    <v-chip>8:00PM</v-chip>
                    <v-chip>9:00PM</v-chip>
                  </v-chip-group>
                </v-card-text>
                <v-card-actions>
                  <v-btn color="deep-purple lighten-2" text>Reserve</v-btn>
                </v-card-actions>
              </v-card>
            </v-col>
          </div>
        </v-row>
      </v-row>
    </v-col>
  </v-row>
</template>
<script>
import { mapState } from "vuex";

export default {
  data: function() {
    return {
      loading: false
    };
  },
  computed: {
    ...mapState(["conferences"])
  },
  mounted() {
    this.fetchConferences();
    this.$store.getters.getConferences;
  },
  methods: {
    fetchConferences() {
      this.loading = true;
      this.$store.dispatch("fetchConferences").then(response => {
        this.loading = false;
      });
    }
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
