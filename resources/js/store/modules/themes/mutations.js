const SET_THEME = (state, payload) => {
        state.theme = payload
        state.themes.push(payload)
        state.theme = {}
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
export default {
    SET_THEME, 
    FETCH_THEMES,
    FETCH_THEME,
    DELETE_THEME
}