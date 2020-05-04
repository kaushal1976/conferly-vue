import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from '../components/auth/Login';
import Logout from '../components/auth/Logout';
import Stepper from '../components/conference/Stepper.vue'
import Conferences from '../components/conference/Conferences.vue'
import Conference from '../components/conference/Conference.vue'

import ThemeForm from '../components/themes/ThemeForm.vue'

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
            component: Stepper,
            name: 'create-conference'
        },
        {
            path: '/conferences/:conferenceId/',
            component: Conference,
            name: 'view-conference'

        },
        {
            path: '/conferences/:conferenceId/edit',
            component: Stepper,
            name: 'edit-conference'
        },

        {
            path: '/themes/:themeId/edit',
            component: Stepper,
            name: 'edit-theme'
        },
    ]
});

