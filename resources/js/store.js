import axios from 'axios'
export default {
    state:{
        conferences: [],
        domains: [],
        themes:[],
        conference: {},
        theme:{}
    },
    mutations:{
        'ADD_CONFERENCE'(state, payload) {
            state.conference = payload
            state.conferences.push(payload)
        },
        'ADD_THEME'(state, payload) {
            state.theme = payload
            state.themes.push(payload)
        },
        'DO_SEARCH'(state, suggestions) {
            Object.keys(suggestions).forEach(key => {
                let domain = {}
                domain = suggestions[key]
                domain.name= key
                state.domains.push(domain)
            });
        },
    },
    getters:{

    },
    actions:{
        addConference: ({ commit }, payload) => {
            commit('ADD_CONFERENCE', payload)
        },
        addTheme: ({ commit }, payload) => {
            commit('ADD_THEME', payload)
        },

        doSearch: ({ commit }, payload) => {
            return axios.post('/api/domain/search', payload)
                .then(response => {
                    commit('DO_SEARCH', response.data)
                })
                .catch(error=> {
                    console.log(error)
                })

        },
    }

}