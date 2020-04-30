<template>
    <div>
        <v-data-table
                :headers="headers"
                :items="themes"
                sort-by="name"
                class="elevation-1"
                outlined
        >
            <template v-slot:top>
                <v-toolbar flat color="white">
                    <v-toolbar-title>Themes</v-toolbar-title>
                    <v-divider
                            class="mx-4"
                            inset
                            vertical
                    ></v-divider>
                    <v-spacer></v-spacer>
                    <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on }">
                            <v-btn outlined large color="indigo" v-on="on">
                                <v-icon>mdi-plus</v-icon>
                                New Theme
                            </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="headline">{{ formTitle }}</span>
                            </v-card-title>
                            <v-card-text>
                                    <v-container>
                                        <v-row>
                                            <v-col cols="12">
                                                <v-text-field
                                                        label="Enter a title for the Theme"
                                                        v-model="theme.title"
                                                        :rules=titleRules
                                                        outlined
                                                        required
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12">
                                                <v-textarea
                                                        label="A description for the Theme"
                                                        v-model="theme.description"
                                                        rows="5"
                                                        :rules="descriptionRules"
                                                        outlined
                                                        required
                                                ></v-textarea>
                                            </v-col>
                                            <v-col cols="12">
                                                <v-autocomplete
                                                        v-model="theme.coordinators"
                                                        :items="users"
                                                        outlined
                                                        chips
                                                        multiple
                                                ></v-autocomplete>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                                <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon
                        small
                        class="mr-2"
                        @click="editItem(item)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                        small
                        @click="deleteItem(item)"
                >
                    mdi-delete
                </v-icon>
            </template>
            <template v-slot:no-data>
                <h2>No themes added yet</h2>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    import {mapState} from 'vuex'

    export default {
        data: function () {
            return {
                theme: {},
                valid: false,
                titleRules: [
                    v => !!v || "Title is required",
                ],
                descriptionRules: [v => !!v || "Description is required"],
                dialog: false,
                headers: [
                    {
                        text: 'Theme Title',
                        align: 'start',
                        sortable: false,
                        value: 'title',
                    },
                    {text: 'Description', value: 'description'},
                    {text: 'Coordinators', value: 'coordinators'},
                    {text: 'Actions', value: 'actions', sortable: false},
                ],
                themes: [],
                editedIndex: -1,
                users: [
                ]
            }
        },
        props: {},
        methods: {
            addTheme() {
                if (this.$refs.themeForm.validate()) {
                    this.$store.dispatch('addTheme', {...this.theme})
                    this.$emit('complete')
                }
            },
            complete() {
                this.$emit('complete')
            },
            previous() {
                this.$emit('previous')
            },
            initialize() {
                    this.themes = [
                    ]
            },
            editItem(item) {
                this.editedIndex = this.themes.indexOf(item)
                this.theme = Object.assign({}, item)
                this.dialog = true
            },
            deleteItem(item) {
                const index = this.themes.indexOf(item)
                confirm('Are you sure you want to delete this item?') && this.themes.splice(index, 1)
            },
            close() {
                this.dialog = false
                setTimeout(() => {
                    this.theme = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                }, 300)
            },
            save() {
                if (this.editedIndex > -1) {
                    Object.assign(this.themes[this.editedIndex], this.editedItem)
                } else {
                    this.desserts.push(this.editedItem)
                }
                this.close()
            },
        },

        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
            },

            ...mapState(['conference']),
        },

        watch: {
            dialog(val) {
                val || this.close()
            },
        },

        created() {
            this.initialize()
        },
    }
</script>