import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from '../components/auth/Login';
import Logout from '../components/auth/Logout';
import ConferenceForm from '../components/conference/ConferenceForm.vue'
import Conferences from '../components/conference/Conferences.vue'
import Conference from '../components/conference/Conference.vue'

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes : [
        {
            path: '/',
            component: Conferences,
            name: 'home'
        },
        {
            path: '/login',
            component: Login,
            name: 'login'
        },
        {
            path: '/logout',
            component: Logout,
            name: 'logout'
        },
        {
            path: '/conferences',
            component: Conferences,
            name: 'conferences'
        },
        {
            path: '/conferences/create',
            component: ConferenceForm,
            name: 'create-conference'
        },
        {
            path: '/conferences/:conferenceId/',
            component: Conference,
            name: 'view-conference'

        },
        {
            path: '/conferences/:conferenceId/edit',
            component: ConferenceForm,
            name: 'edit-conference'
        },
    ]
});

