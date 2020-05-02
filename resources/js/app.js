require('./bootstrap');
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import VueFileAgentStyles from 'vue-file-agent/dist/vue-file-agent.css';
import Vuetify from 'vuetify'
import moment from 'vue-moment'
import Vue from 'vue';
import router from './router';
import MainApp from './components/MainApp.vue'
import store from './store'


Vue.use(moment);
Vue.use(Vuetify);

const vuetify = new Vuetify();

const app = new Vue({
    el: '#app',
    components: {
        MainApp, 
    },
    router,
    store,
    moment,
    vuetify,
});
