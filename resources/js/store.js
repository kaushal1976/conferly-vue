export default {

    state:{
        tests:[],
        conferences: [],
    },
    mutations:{
        'ADD_CONFERENCE'(state, payload) {

            state.conferences.push(payload)
        },
    },
    getters:{

    },
    actions:{
        addConference: ({ commit }, payload) => {
            commit('ADD_CONFERENCE', payload)
        },
    }

}