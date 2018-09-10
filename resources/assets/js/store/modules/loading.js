// initial state
// shape: [{ id, quantity }]
const state = {
    showSpinner: false
}

// getters
const getters = {
    spinnerIsShowing: (state, getters, rootState) => {
        return state.showSpinner
    }
}

// actions
const actions = {
    showLoadingSpinner({commit, state}) {
        commit('setSpinnerToShow')
    },
    hideLoadingSpinner({ commit, state }) {
        commit('setSpinnerToHide')
    }

}

// mutations
const mutations = {
    setSpinnerToShow(state) {
        state.showSpinner = true
    },
    setSpinnerToHide(state) {
        state.showSpinner = false
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}