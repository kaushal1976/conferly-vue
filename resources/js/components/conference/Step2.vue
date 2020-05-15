<template>
  <v-row justify="center" align="start" class="fill-height">
    <v-col cols="12" lg="10" xl="7">
      <v-card class="px-5 py-6" :outlined="true">
        <ThemeForm
          v-if="showThemeForm"
          :showThemeForm="showThemeForm"
          @cancelled="showThemeFormToggle"
        ></ThemeForm>
        <Themes @themeForm="showThemeFormToggle"></Themes>
        <v-divider></v-divider>
        <v-card-actions>
          <v-btn
            @click.stop="previous"
            class="no-uppercase"
            color="primary"
            :rounded="rounded"
            :dense="dense"
            :large="btnLarge"
            elevation="0"
          >Previous
          </v-btn>
          <v-btn
            class="no-uppercase"
            color="primary"
            @click.stop="complete"
            :rounded="rounded"
            :dense="dense"
            :large="btnLarge"
            elevation="0"
            :disabled="!themes.length"
          >Next</v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import Themes from "../themes/Themes";
import ThemeForm from "../themes/ThemeForm";
export default {
  components: {
    Themes,
    ThemeForm
  },
  data() {
    return {
      asyncErrors: [],
      rounded: false,
      dense: false,
      btnLarge: true,
      valid: false,
      titleRules: [v => !!v || "Title is required"],
      descriptionRules: [v => !!v || "Description is required"],
      showThemeForm: false
    };
  },

  methods: {
    ...mapActions({
      deleteTheme: "themes/deleteTheme"
    }),

    previous() {
      this.$emit("previous");
    },

    showThemeFormToggle() {
      this.showThemeForm = !this.showThemeForm;
    },

    complete() {
      this.$emit("complete");
    }
  },
  computed: {
    ...mapGetters({
      themes: "themes/getThemes",
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
