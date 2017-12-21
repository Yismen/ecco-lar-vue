import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        show: false
    },
    mutations: {
        show(state) {
            return state.show = true
        }, 

        hide(state) {
            return state.show = false
        }
    },
    getters: {
        isShowing(state) {
            return state.show
        }
    }
});