const getThemes = state => state.themes
const getTheme = state => state.theme
const getThemeLeaders = state => state.theme.themeLeaders

const themeLeaderExists = (state) => (email) => {
     let index = state.theme.themeLeaders.findIndex(themeLeader => themeLeader.user.email === email)
     if (index == (-1)) {
         return false
     } else {
         return true
     }
 }

export default {
    getThemes,
    getTheme,
    getThemeLeaders,
    themeLeaderExists
}