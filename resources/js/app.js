

require('./bootstrap');
import 'element-ui/lib/theme-chalk/index.css';
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import locale from 'element-ui/lib/locale/lang/en';
import Vuetify from 'vuetify'

import Vue from 'vue';
import VueRouter from 'vue-router';
import ElementUI from 'element-ui';
import Vuex from 'vuex';
import {routes} from './routes';
import MainApp from './components/MainApp.vue'
import StoreData from './store'

Vue.use(VueRouter);
Vue.use(ElementUI, { locale });
Vue.use(Vuex);
Vue.use(Vuetify);

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
    vuetify
});
