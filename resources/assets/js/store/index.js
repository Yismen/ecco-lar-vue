import Vue from 'vue'
import Vuex from 'vuex'
import loading from './modules/loading';
import employee from './modules/employee';

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        loading, employee
    },
    strict: debug
})