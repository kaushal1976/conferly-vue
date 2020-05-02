import axios from 'axios'
import {
    objectToFormData
} from 'object-to-formdata';
export default {
    state: {
        conferences: [],
        conference: {},
        themes: [],
        theme: {},
    },
    mutations: {
        ADD_CONFERENCE(state, payload) {
            state.conference = payload
            state.conferences.push(payload)
        },
        DELETE_CONFERENCE(state, id) {
            let index = state.conferences.findIndex(conference => conference.id == id)
            if (index !== (-1)) {
                state.conferences.splice(index, 1)
            }
        },
        FETCH_CONFERENCES(state, conferences) {
            state.conferences = conferences
        },
        FETCH_CONFERENCE(state, conference) {
            state.conference = conference
        },


        ADD_THEME(state, payload) {
            state.theme = payload
            state.themes.push(payload)
        },
        FETCH_THEMES(state, themes) {
            state.themes = themes
        },
        DELETE_THEME(state, id) {
            let index = state.themes.findIndex(theme => theme.id == id)
            if (index !== (-1)) {
                state.themes.splice(index, 1)
            }
        },
    },
    getters: {
        getConferences: state => {
            return state.conferences
        },
        getThemes: state => {
            return state.themes
        },
        getConference: state=> {
            return state.conference
        }

    },
    actions: {
        addConference: ({commit}, payload) => {
            const formData = objectToFormData(payload);
            let path = '/api/conference/'
            let settings = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            if (payload.id > 0) {
                formData.append("_method", "put")
                path = path + payload.id
            }
            return axios.post(path, formData, settings)
                .then(response => {
                    commit('ADD_CONFERENCE', response.data)
                })
                .catch(error => {
                    throw error
                })

        },
        fetchConferences: ({commit}) => {
            return axios.get('/api/conference')
                .then(response => {
                    commit('FETCH_CONFERENCES', response.data)
                })
                .catch(error => {
                    throw error
                })
        },
        fetchConference: ({commit}, payload) => {
            return axios.get('/api/conference/' + payload)
                .then(response => {
                    commit('FETCH_CONFERENCE', response.data)
                })
                .catch(error => {
                    throw error
                })
        },
        deleteConference: ({
            commit
        }, id) => {
            return axios.delete('/api/conference/' + id)
                .then(response => {
                    commit('DELETE_CONFERENCE', id)
                })
                .catch(error => {
                    throw error
                })

        },
        addTheme: ({commit, state}, payload) => {
            let path = '/api/conference/' + state.conference.id + '/themes/'
            const formData = objectToFormData(payload);
            let settings = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            if (payload.id > 0) {
                formData.append("_method", "put")
                path = path + payload.id
            }
            return axios.post(path, formData, settings)
                .then(response => {
                    commit('ADD_THEME', payload)
                })
                .catch(error => {
                    throw error
                })
        },

        fetchThemes: ({
            commit
        }, payload) => {
            return axios.get('/api/conference/' + payload + '/themes/')
                .then(response => {
                    commit('FETCH_THEMES', response.data)
                })
                .catch(error => {
                    throw error
                })
        },
        deleteTheme: ({
            commit
        }, id) => {
            return axios.delete('/api/theme/' + id)
                .then(response => {
                    commit('DELETE_THEME', id)
                })
                .catch(error => {
                    throw error
                })
        },
    }

}
