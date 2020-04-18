import Home from './components/Home.vue';
import Login from './components/auth/Login';
import Logout from './components/auth/Logout';
import Conference from './components/conference/ConferenceForm.vue'
import Conferences from './components/conference/Conferences.vue'
import Search from './components/domain/Search.vue'
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
    },
    {
        path: '/conferences',
        component: Conferences
    },
    {
        path: '/domain/search',
        component: Search
    }
];
    