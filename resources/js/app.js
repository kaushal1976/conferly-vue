require('./bootstrap');
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import VueFileAgentStyles from 'vue-file-agent/dist/vue-file-agent.css';
import Vuetify from 'vuetify'
import moment from 'vue-moment'
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueFileAgent from 'vue-file-agent';
import Vuex from 'vuex';
import {routes} from './routes';
import MainApp from './components/MainApp.vue'
import StoreData from './store'

Vue.use(moment)
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(Vuetify);
Vue.use(VueFileAgent);

const router = new VueRouter({
    routes,
    mode:'history'
});

const store = new Vuex.Store(StoreData);
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
