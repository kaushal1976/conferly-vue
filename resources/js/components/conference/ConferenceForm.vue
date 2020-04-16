<template>
    <v-layout class="align-top">
        <v-stepper v-model="e1" class="elevation-0 flex py-0">
            <v-stepper-header class="elevation-0 py-0">
                <v-stepper-step :complete="e1 > 1" step="1">Initial Details</v-stepper-step>
                <v-divider></v-divider>
                <v-stepper-step :complete="e1 > 2" step="2">Themes</v-stepper-step>
                <v-divider></v-divider>
                <v-stepper-step step="3">Theme Leaders</v-stepper-step>
            </v-stepper-header>
            <v-stepper-content
                    :key="`1-content`"
                    :step="1"
                    class="py-0"
            >
                <Step1
                        @complete="nextStep"
                />
            </v-stepper-content>
            <v-stepper-content
                    :key="`2-content`"
                    :step="2"
                    class="py-0"
            >
                <Step2
                        @complete="nextStep"
                        @previous="previousStep"
                />
            </v-stepper-content>
        </v-stepper>
    </v-layout>
</template>
<style scoped>
</style>
<script>
    import Step1 from './Step1.vue'
    import Step2 from './Step2.vue'

    export default {
        data() {
            return {
                e1: 1,
            };
        },
        methods: {
            nextStep() {
                this.e1++
            },
            previousStep() {
                this.e1--
            }
        },
        computed: {},
        components: {
            Step1,
            Step2
        }
    };
</script>
