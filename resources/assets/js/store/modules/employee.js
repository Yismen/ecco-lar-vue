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
    getAddress(state, getters, rootState) {
        return getters.getEmployee.address ? getters.getEmployee.address : state.address
    }
}

// actions (an action commit a mutation)
const actions = {
    set({ commit, state }, employee) {
        commit('mutateEmployee', employee)
    },
    updateAddress({commit, state}, address) {
        commit('mutateAddress', address)
    },
    updateHireDate({ commit, state }, hire_date) {
        commit('mutateHireDate', hire_date)
    }
}

// mutations (a mutation update the state)
const mutations = {
    mutateEmployee(state , employee ) {
        state.employee = employee
        state.address = employee.address
    },
    mutateAddress(state, address) {
        state.employee.address = address
        state.address = address
    },
    mutateHireDate(state, hire_date) {
        state.employee.hire_date = hire_date
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}