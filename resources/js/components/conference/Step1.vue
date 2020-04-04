<template>
    <v-form v-model="valid" ref="conferenceForm" @submit.prevent class="compact-form py-0">
        <v-row class="justify-center py-0">
            <v-col cols="12">
                <v-text-field
                        label="Enter a title for the Conference"
                        v-model="conference.title"
                        :rules="titleRules"
                        outlined
                        required
                ></v-text-field>
                <v-text-field
                        label="Enter a Tag Line for the Conference"
                        v-model="conference.tagLine"
                        :rules="tagLineRules"
                        outlined
                        required
                ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" justify="center" class="py-0">
                <v-menu
                        v-model="sDateMenu"
                        :close-on-content-click="false"
                        :nudge-right="40"
                        transition="scale-transition"
                        offset-y
                        min-width="290px"
                >
                    <template v-slot:activator="{ on }">
                        <v-text-field
                                v-model="sDate"
                                label="Start Date"
                                append-icon="mdi-calendar"
                                :rules="dateRules"
                                outlined
                                readonly
                                v-on="on"
                        ></v-text-field>
                    </template>
                    <v-date-picker
                            v-model="sDate"
                            @input="sDateChanged"
                    ></v-date-picker>
                </v-menu>
            </v-col>
            <v-col cols="12" sm="6" justify="center" class="py-0">
                <v-menu
                        v-model="fDateMenu"
                        :close-on-content-click="false"
                        :nudge-right="40"
                        transition="scale-transition"
                        offset-y
                        min-width="290px"
                >
                    <template v-slot:activator="{ on }">
                        <v-text-field
                                v-model="fDate"
                                label="End Date"
                                append-icon="mdi-calendar"
                                :rules="dateRules"
                                outlined
                                readonly
                                v-on="on"
                                :disabled="fDateDisabled"
                        ></v-text-field>
                    </template>
                    <v-date-picker
                            v-model="fDate"
                            @input="fDateMenu = false"
                            :min="minDate"
                    >
                    </v-date-picker>
                </v-menu>
            </v-col>
            <v-col cols="12">
                <v-text-field
                        label="Enter the venue of the Conference"
                        v-model="conference.venue"
                        :rules="venueRules"
                        outlined
                        required
                ></v-text-field>
                <v-text-field
                        label="Enter Subject Area the Conference"
                        v-model="conference.subject"
                        :rules="subjectRules"
                        outlined
                        required
                ></v-text-field>
            </v-col>
            <v-col cols="12" class="py-0">
                <v-textarea
                        label="A description for the Conference"
                        v-model="conference.description"
                        rows="5"
                        :rules="descriptionRules"
                        outlined
                        required

                ></v-textarea>
            </v-col>
            <v-col cols="12" class="py-0">
                <v-btn
                        @click="addConference(conference)"
                        outlined
                >
                    Next
                </v-btn>
            </v-col>

        </v-row>
    </v-form>
</template>
<style scoped>
    .compact-form {
        transform: scale(0.875);
    }
</style>
<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                conference: {},
                valid: false,
                titleRules: [v => !!v || "Title is required"],
                tagLineRules: [v => !!v || "Tag line is required"],
                dateRules:[v=>!this.fDateDisabled||"Please check Start and End dates of the Conference"],
                descriptionRules:[v => !!v || "Description is required"],
                venueRules:[v => !!v || "Venue is required"],
                subjectRules:[v => !!v || "Subject is required"],
                sDate: new Date().toISOString().substr(0, 10),
                fDate: new Date().toISOString().substr(0, 10),
                fDateDisabled:true,
                sDateMenu: false,
                fDateMenu: false,
                modal: false,
            };
        },

        methods: {
            addConference(conference) {

                this.$refs.conferenceForm.validate()
                axios.post('/api/conferences', conference)
                    .then(success=> {

                    })
                    .catch(errors=> {

                        this.titleRules=errors.response.data.errors.title
                        alert(JSON.stringify(errors.response.data.errors.title))

                    })

            },

            sDateChanged() {
                this.fDateDisabled=false
                this.sDateMenu = false
                if (new Date(this.sDate).getTime() > new Date(this.fDate).getTime()) {
                    this.fDate=this.sDate
                }
            },

        },
        computed: {
            minDate() {
                return this.sDate
            },
        },
    };
</script>