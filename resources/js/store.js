import axios from 'axios'
export default {
    state:{
        conferences: [],
    },
    mutations:{
        'ADD_CONFERENCE'(state, payload) {
            state.conferences.push(payload)
        },
        'DO_SEARCH'(state, payload) {
            state.conferences.push(payload)
        },
    },
    getters:{

    },
    actions:{
        addConference: ({ commit }, payload) => {
            commit('ADD_CONFERENCE', payload)
        },

        doSearch: ({ commit }, payload) => {
            axios.post('/api/domain/search', payload)
                .then(response => {
                })
                .catch(error=> {
                })
            commit('DO_SEARCH', payload)
        },
    }

}