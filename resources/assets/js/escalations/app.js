var Vue = require('vue');
window.Vue = Vue;

// window.Toast = require('vue-toast-mobile').default;
window.Toast = require('v-toast').default;

/**
 * Require Libraries
 */
var VueRouter = require('vue-router');
var VueResource = require('vue-resource');

/**
 * Libraries to use. These libraries are added as part of the constructor.
 * Whithin the instance they can be referenced with the 'this' key.
 */
Vue.use(VueRouter);
Vue.use(VueResource);

// Vue.use(progress);

/**
 * Configuration session
 */
Vue.config.debug = true // Comment this line for production
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('content');

/**
 * Override Transitions
 */
Vue.transition('fade', {
    enterClass: 'fadeIn',
    leaveClass: 'fadeOut'
});
Vue.transition('faderight', {
    enterClass: 'fadeInRight',
    leaveClass: 'fadeOutRight'
});
Vue.transition('fadeleft', {
    enterClass: 'fadeInLeft',
    leaveClass: 'fadeOutLeft'
});

/**
 * Intercepting the http
*/
Vue.http.interceptors.push(require('./config/interceptors.js'));
let routes = require('./core/routes.js');

// const router = new VueRouter({
//   routes // short for routes: routes
// });

// new Vue({
//   router
// }).$mount('body')

var App = Vue.extend({
    data() {
        return {
            errors: 5151
        }
    }
});
var router = new VueRouter({
    saveScrollPosition: true,
    exact: true,
    linkActiveClass: 'active',
});
router.map(routes).start(App, 'body');

window.router = router;