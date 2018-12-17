// initial state
// shape: [{ id, quantity }]
const state = {
    employee: {},
    address: {
        city: "",
        sector: "",
        street_address: ""
    }
}

// getters
const getters = {
    getEmployee: (state, getters, rootState) => {
        return state.employee
    },
}

// actions (an action commit a mutation)
// this.$store.dispatch('employee/action')
const actions = {
    set({ commit, state }, employee) {
        commit('updateEmployee', employee)
    },
    addLoginName({commit, state}, loginName) {
        commit('addLoginName', loginName)
    },
    updateLoginName({commit, state}, loginName, index) {
        commit('updateLoginName', loginName)
    }
}

// mutations (a mutation update the state)
const mutations = {
    updateEmployee(state , employee ) {
        state.employee = employee
    },
    addLoginName(state, loginName) {
        state.employee.login_names.unshift(loginName)
    },
    updateLoginName(state, login) {
        state.employee.login_names[login.index].login = login.login
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}