
import Login from './components/auth/Login';
import Logout from './components/auth/Logout';
import ConferenceForm from './components/conference/ConferenceForm.vue'
import Conferences from './components/conference/Conferences.vue'
import Conference from './components/conference/Conference.vue'
export const routes = [
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
];
