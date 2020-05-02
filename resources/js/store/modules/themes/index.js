import actions from './actions';
import getters from './getters';
import mutations from './mutations';

const state = {

    theme:{},
    themes:[]
}

export default {
    namespaced: true,
    state,
    actions,
    getters,
    mutations,
}