/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/**
 * Now we import the main store from vuex
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

const app = new Vue({
    store,
    el: '#app'
});