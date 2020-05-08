import actions from './actions';
import getters from './getters';
import mutations from './mutations';

const state = {

    theme: {
        themeLeaders: [],
        themeLeader: {
            user: {}
        }
    },
    themes: [],
}

export default {
    namespaced: true,
    state,
    actions,
    getters,
    mutations,
}
