import Home from './components/Home.vue';
import Login from './components/auth/Login';
import Logout from './components/auth/Logout';
import ConferenceForm from './components/conference/ConferenceForm.vue'
import Conferences from './components/conference/Conferences.vue'
import Conference from './components/conference/Conference.vue'
import Search from './components/domain/Search.vue'
import Image from './components/general/Image.vue'
export const routes = [
    //Auth
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
    //Conference
    {
        path: '/conference',
        component: Conferences
    },
    {
        path: '/conference/create',
        component: ConferenceForm
    },
    {
        path: '/conference/:id/',
        component: Conference
    },
    {
        path: '/conference/:id/edit',
        component: ConferenceForm
    },
    //Domains
    {
        path: '/domain/search',
        component: Search
    }
];
