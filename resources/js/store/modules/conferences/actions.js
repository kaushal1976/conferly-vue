import router from "../../../router";
import { objectToFormData} from 'object-to-formdata';

const setConference = ({commit}, payload) => {
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
            commit('SET_CONFERENCE', response.data)
        })
        .catch(error => {
            throw error
        })

}

const fetchConferences = ({commit}) => {

    return axios.get('/api/conferences')
        .then(response => {
            commit('FETCH_CONFERENCES', response.data)
        })
        .catch(error => {
            throw error
        })
}

const fetchConference = ({commit}, payload) => {
    if (!payload > 0) {
        commit('FETCH_CONFERENCE', {})
        commit('themes/FETCH_THEMES', [], {root: true})
        return
    }
    return axios.get('/api/conference/' + payload)
        .then(response => {
            commit('FETCH_CONFERENCE', response.data)
            commit('themes/FETCH_THEMES', response.data.themes, {root: true})
        })
        .catch(error => {
            commit('FETCH_CONFERENCE', {})
            router.push({name:'create-conference'})
        })
}

const deleteConference = ({commit}, id) => {
    return axios.delete('/api/conference/' + id)
        .then(response => {
            commit('DELETE_CONFERENCE', id)
        })
        .catch(error => {
            throw error
        })

}

export default {
    setConference,
    fetchConferences,
    fetchConference,
    deleteConference
}
