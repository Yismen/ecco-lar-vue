/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

/**
 * Here we will load Vue store with it modulations. This implements
 * an API to have centralized states and mutations.
 */
import store from './store'

/**
 * Here we implement the Vue Router plugin. Routes are imported
 * from a routes files
 */
// import VueRouter from 'vue-router'
// Vue.use(VueRouter)
// import routes from './routes'
// const router = new VueRouter({
//     routes
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import MIXINS from './mixins'
const app = new Vue({
    store,
    el: '#app',
    mixins: [MIXINS]
});