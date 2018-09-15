
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Now we import the main store from vuex
 */
import store from './store'

/**
 * Here we implement the Vue Router plugin. Routes are imported
 * from a routes files
 */
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import routes from './routes'
const router = new VueRouter({
    routes
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('loading-component', require('./components/LoadingComponent.vue'));
Vue.component( 'passport-clients', require('./components/passport/Clients.vue') );
Vue.component( 'passport-authorized-clients', require('./components/passport/AuthorizedClients.vue') );
Vue.component( 'passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue') );
Vue.component( 'users-registered', require('./components/users/Registered') );
// import GlobalComponents from './components/globals'

const app = new Vue({
    // components: GlobalComponents,
    router,
    store,
    el: '#app'
});