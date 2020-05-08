const SET_THEME = (state, payload) => {
    state.theme = payload
    state.themes.push(payload)
    state.theme = {}
    state.theme.themeLeaders = []
    state.theme.themeLeader = {}
}

const SET_THEME_LEADER = (state, payload) => {
    state.theme.themeLeader = payload
    state.theme.themeLeaders.push(payload)
    state.theme.themeLeader = {}
}

const SET_THEME_LEADER_USER = (state, payload) => {
    state.theme.themeLeader.user = payload
}

const FETCH_THEMES = (state, themes) => {
    state.themes = themes
}

const FETCH_THEME = (state, theme) => {
    state.theme = theme
}
const DELETE_THEME = (state, id) => {
    let index = state.themes.findIndex(theme => theme.id == id)
    if (index !== (-1)) {
        state.themes.splice(index, 1)
    }
}

const DELETE_THEME_LEADER = (state, themeLeader) => {
    let index = state.theme.themeLeaders.indexOf(themeLeader)
    if (index !== (-1)) {
        state.theme.themeLeaders.splice(index, 1)
    }
}

export default {
    SET_THEME,
    SET_THEME_LEADER,
    FETCH_THEMES,
    FETCH_THEME,
    DELETE_THEME,
    DELETE_THEME_LEADER,
    SET_THEME_LEADER_USER

}
