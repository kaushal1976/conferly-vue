import { objectToFormData} from 'object-to-formdata';
import router from "../../../router";

const setTheme = ({commit}, payload) => {

    if (!payload.conferenceId > 0) {
       router.push({name: 'home'})
    }

    let path = '/api/conference/' + payload.conferenceId + '/themes/'
    const options = { indices: true, nullsAsUndefineds: false,booleansAsIntegers: false,};
    const formData = objectToFormData(payload, options);
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
            commit('SET_THEME', response.data)
        })
        .catch(error => {
            throw error
        })
}

const setThemeLeader = ({commit}, payload) => {
    commit('SET_THEME_LEADER', payload) 
}

const findUser = ({commit}, payload) => {
    const formData = objectToFormData(payload);
    let settings = {
        headers: {
            'content-type': 'multipart/form-data'
        }
    }
    let path = '/api/theme-leaders/find-user' 
    return axios.post(path, formData, settings)
        .then(response => {
            commit('SET_THEME_LEADER_USER', response.data)
        })
        .catch(error => {
            throw error
        })
}

const deleteThemeLeader = ({commit}, payload) => {
    commit('DELETE_THEME_LEADER', payload)
}

const deleteTheme = ({commit}, id) => {
            return axios.delete('/api/themes/' + id)
                .then(response => {
                    commit('DELETE_THEME', id)
                })
                .catch(error => {
                    throw error
                })
        }

export default {
    setTheme,
    deleteTheme,
    setThemeLeader,
    deleteThemeLeader,
    findUser
}