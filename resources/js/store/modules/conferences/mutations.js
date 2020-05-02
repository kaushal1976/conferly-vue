
const SET_CONFERENCE = (state, payload) => {
        state.conference = payload
        state.conferences.push(payload)
    }
const DELETE_CONFERENCE = (state, id) => {
        let index = state.conferences.findIndex(conference => conference.id == id)
        if (index !== (-1)) {
            state.conferences.splice(index, 1)
        }
    }
const FETCH_CONFERENCES = (state, conferences) => {
        state.conferences = conferences
    }

const FETCH_CONFERENCE = (state, conference) => {
        state.conference = conference
    }

const SET_LOADING = (state, leading) => {
        state.loading = loading
    }

export default {
    SET_CONFERENCE,
    DELETE_CONFERENCE,
    FETCH_CONFERENCES,
    FETCH_CONFERENCE,
    SET_LOADING
}