import axios from 'axios'
export default {
    state:{
        conferences: [],
        domains: [],
        themes:[],
        conference: {},
        theme:{},
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
        FETCH_CONFERENCES (state, conferences) {
           state.conferences = conferences
        },
        FETCH_CONFERENCE (state, conference) {
            state.conference = conference
        }
    },
    getters:{
        getConferences: state => {
            return state.conferences
        }
    },
    actions:{
        addConference: ({ commit }, payload) => {
            let conference = new FormData();
            conference.append('image', payload.image)
            conference.append('title', payload.title)
            conference.append('description', payload.description)
            conference.append('venue', payload.venue)
            conference.append('subject_area', payload.subject_area)
            conference.append('start_date', payload.start_date)
            conference.append('end_date', payload.end_date)
            conference.append('tag_line', payload.tag_line)

            let settings = { headers: { 'content-type': 'multipart/form-data' } }
            return axios.post('/api/conference/', conference, settings)
                .then(response => {
                    commit('ADD_CONFERENCE', payload)
                })
                .catch(error=> {
                    throw error
                })
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
        fetchConferences: ({ commit }) => {
            return axios.get('/api/conference')
                .then(response => {
                    commit('FETCH_CONFERENCES', response.data)
                })
                .catch(error=> {
                    console.log(error)
                })
        },
        fetchConference: ({ commit }, payload) => {
            return axios.get('/api/conference/'+payload)
                .then(response => {
                    console.log(response.data)
                    commit('FETCH_CONFERENCE', response.data)
                })
                .catch(error=> {
                    console.log(error)
                })
        },
    }

}
