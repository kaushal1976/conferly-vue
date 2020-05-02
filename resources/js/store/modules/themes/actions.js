import { objectToFormData} from 'object-to-formdata';

const setTheme = ({commit}, payload) => {

    let path = '/api/conference/' + payload.conferenceId + '/themes/'
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
            commit('SET_THEME', payload)
        })
        .catch(error => {
            throw error
        })
}

const fetchThemes = ({commit}, payload) => {
        return axios.get('/api/conference/' + payload + '/themes/')
            .then(response => {
                commit('FETCH_THEMES', response.data)
            })
            .catch(error => {
                throw error
            })
    }
const deleteTheme = ({commit}, id) => {
            return axios.delete('/api/theme/' + id)
                .then(response => {
                    commit('DELETE_THEME', id)
                })
                .catch(error => {
                    throw error
                })
        }

export default {
    setTheme,
    fetchThemes,
    deleteTheme
}