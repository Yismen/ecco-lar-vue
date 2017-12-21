const store = new Vuex.Store({
    state: {
        users = []
    },
    mutations: {
        addUser(state, user) {
            state.push(user)
        }
    },
    actions: {
        addUser (context, user) {
            context.commit('addUser')
        }
    },
    getters: {
        user() {
            
        }
    }
})