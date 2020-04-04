import Home from './components/Home.vue';
import Login from './components/auth/Login';
import Logout from './components/auth/Logout';
import Conference from './components/conference/ConferenceForm.vue'

export const routes = [

    {
        path: '/',
        component: Home

    },

    {
        path: '/login',
        component: Login
    },

    {
        path: '/logout',
        component: Logout
    },

    {
        path: '/conference',
        component: Conference
    }

];
    