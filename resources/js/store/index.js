import Vue from 'vue'
import Vuex from 'vuex';
import themesModule from './modules/themes'
import conferencesModule from './modules/conferences'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        themes: themesModule,
        conferences: conferencesModule,
    },
});