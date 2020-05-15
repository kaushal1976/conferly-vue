<template>
<v-container fluid fill-height class="px-0 py-0">
      <v-row align="start" justify="center" class="grey lighten-3 mx-0 fill-height">
        <v-col cols="12">
          <v-card color="grey lighten-2" class="px-3 py-3" flat>
            <h1 class="font-weight-light"><span>Confer<b>ly</b></span></h1>
            <p class="lead text-muted">
              Helping to manage academic conferences worldwide. Paper management process, Review process,
              Registrations and payments, managing parallel tracts and many more...
            </p>
            <p>
              <v-btn
                class="no-uppercase my-2 md-full-width"
                elevation="0"
                :to="{name: 'create-conference'}"
                large
                color="primary"
              >
                Create a
                new Conference
              </v-btn>
              <v-btn
                class="no-uppercase my-2 md-full-width"
                elevation="0"
                :to="{name: 'conferences'}"
                large
                color="primary"
              >Search Conferences</v-btn>
            </p>
          </v-card>
        </v-col>
        <v-col v-if="loading" cols="12">
          <v-skeleton-loader type="list-item-avatar-three-line"></v-skeleton-loader>
        </v-col>
        <v-col cols="12" v-if="conferences.length">
          <v-row justify="center">
              <v-card v-for="conference in conferences" class="my-2 mx-2" max-width="374" elevation="0" :key="conference.id" >
                <v-img height="250" :src='"/storage/conference/images/"+conference.image'></v-img>
                <v-card-title>{{conference.title}}</v-card-title>
                <v-card-text>
                  <v-row align="center" class="mx-0">
                    <v-rating :value="4.5" color="amber" dense half-increments size="25"></v-rating>
                    <div class="grey--text ml-4">4.5 (413)</div>
                  </v-row>
                  <div class="my-4 subtitle-1">
                    <i>{{conference.start_date}}</i>
                    <b>To</b>
                    <i>{{conference.end_date}}</i>
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
                  <v-btn @click="deleteConference(conference.id)" color="deep-purple lighten-2" text>Remove</v-btn>
                  <v-btn :to="{ name: 'edit-conference', params: { conferenceId: conference.id } }" color="deep-purple lighten-2" text>Edit</v-btn>
                </v-card-actions>
              </v-card>
          </v-row>
        </v-col>
      </v-row>
</v-container>
</template>
<script>
import {mapGetters} from "vuex";
import {mapActions} from "vuex";

export default {
  data: function() {
    return {
      loading: false,
    };
  },
  computed: {
    ...mapGetters({
      conferences:'conferences/getConferences',
    })
  },
  mounted() {
    this.fetchConferences()
  },
  methods: {
    ...mapActions({
      fetchConferences: 'conferences/fetchConferences',
      deleteConference: 'conferences/deleteConference'
    }),
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