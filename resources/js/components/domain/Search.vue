<template>
    <div class="flex px-5 py-5 mx-5">
        <h2>Search Domains</h2>
        <v-form @submit.stop.prevent="searchDomain" class="py-0" ref="searchForm">
            <v-text-field
                    :rules="searchRules"
                    @input="asyncErrors=''"
                    label="Search for a domain"
                    outlined
                    required
                    v-model="searchForm.search"
                    append-icon="mdi-magnify"
                    @click:append="searchDomain"
            >
            </v-text-field>
        </v-form>
        <v-skeleton-loader
                v-if="loading"
                class="mx-auto"
                type="card"
        >
        </v-skeleton-loader>
        <v-card
                v-if="domains.length > 0"
        >
            <v-list
                    two-line
            >
                <v-subheader class="title">Domains</v-subheader>
                <v-divider></v-divider>
                <template
                        v-for="(domain, i) in domains.slice(0, 6)"
                >
                    <v-list-item
                            :key="domain.name" @click=""
                    >
                        <v-list-item-content>
                            <v-list-item-title v-text="domain.name"></v-list-item-title>
                            <v-list-item-subtitle v-text="domain.status"></v-list-item-subtitle>
                        </v-list-item-content>
                        <v-list-item-icon>
                            <v-icon>star</v-icon>
                        </v-list-item-icon>
                    </v-list-item>
                    <v-divider></v-divider>
                </template>
            </v-list>
        </v-card>
    </div>
</template>

<script>
    import {mapState} from 'vuex'

    export default {
        name: "search",
        data: function () {

            return {
                search: '',
                searchForm: {},
                asyncErrors: '',
                searchRules: [v => !!v || "Enter a search term"],
                loading: false,
            }
        },

        methods: {
            searchDomain() {
                if (this.$refs.searchForm.validate()) {
                    this.loading = true
                    this.$store.dispatch('doSearch', {...this.searchForm})
                        .then(response => {
                            this.loading = false
                        })
                }
            },
        },
        computed:
            mapState([
                'domains'
            ])
    }
</script>

<style scoped>

</style>