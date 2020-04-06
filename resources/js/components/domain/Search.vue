<template>
    <v-layout class="align-top px-5 py-5">
        <div class="display-3">
            <h2>Search Domains</h2>
            <v-form @submit.prevent="searchDomain" class="py-0" ref="searchForm">
                <v-text-field
                        :rules="searchRules"
                        @input="asyncErrors=''"
                        label="Search for a domain"
                        outlined
                        required
                        v-model="searchForm.search"
                        append-icon="mdi-magnify"
                        @click:append = "searchDomain"
                >
                </v-text-field>
            </v-form>
        </div>
    </v-layout>
</template>

<script>
    export default {
        name: "search",

        data: function () {

            return {

                search: '',
                searchForm: {},
                asyncErrors: '',
                valid: false,
                searchRules: [v => !!v || "Enter a search term"],

            }
        },

        methods: {

            searchDomain() {
                if (this.$refs.searchForm.validate()) {
                    this.$store.dispatch('doSearch', {...this.searchForm})
                }

            }
        },
    }
</script>

<style scoped>

</style>