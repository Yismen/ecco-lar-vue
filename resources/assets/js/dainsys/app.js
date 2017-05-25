import Vue from 'vue';
window.Vue = Vue;

Vue.config.debug = true // Comment this line for production

import VueResource from 'vue-resource';
Vue.http = VueResource;
Vue.use(VueResource);

// Vue.http.interceptors.request.use(function(config){
//     config.headers['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('content');
//     return config;
// })

// Vue.http.interceptors.push(function(request, next) {

//   response(res) {
//     console.log(res)
//   }
// });
/**
 * Libraries to use. These libraries are added as part of the constructor.
 * Whithin the instance they can be referenced with the 'this' key.
 */

/**
 * Configuration session
 */

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('content');

/**
 * Intercepting the http
*/
Vue.http.interceptors.push(require('./config/interceptors.js'));

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import routes from './core/routes.js';

const router = new VueRouter({
    routes: routes,
    saveScrollPosition: true,
    linkActiveClass: 'active',
    'active-class': 'active'
});

new Vue({
 el: '#app',

  router: router,

  components: {
    'navigation-view': require('./views/NavigationView'),
    'dainsys-modal': require('vue-bootstrap-modal'),
  },

  data() {
        return {
        }
    },
    created() {
        console.log("Started")
    }
});

window.router = router;
// window.http = axios;