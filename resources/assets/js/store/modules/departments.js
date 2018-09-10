// initial state
// shape: [{ id, quantity }]
const state = {
    items: []
}

// getters
const getters = {
    departments: (state, getters) => {
        return state.departments
    },

    totalDepartments: (state, getters) => {
        return getters.departments.length
    }
}

// actions
const actions = {
    createDepartment({ state, commit }, department) {
        commit('storeDepartment', null)
    },
    editDepartment({ state, commit }, department) {
        commit('updateDepartment', null)
    }
}

// mutations
const mutations = {
    storeDepartment(state, { department }) {
        state.items.push(department)
    },
    updateDepartment(state, { department }) {
        // state.items.push({
        //     id,
        //     quantity: 1
        // })
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}