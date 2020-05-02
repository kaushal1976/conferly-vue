<template>
<div>
    <v-card></v-card>
</div>

    
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
    data() {
        return {

        }
    },

     methods: {
        ...mapActions({
        fetchThemes: 'themes/fetchThemes',
        deleteTheme: 'themes/deleteTheme'
        }),
     },

    computed: {
    ...mapGetters({
      conference:'conferences/getConference',
      themes:'themes/getTheme',
      theme:'themes/getThemes',
    }),

  }
}
</script>