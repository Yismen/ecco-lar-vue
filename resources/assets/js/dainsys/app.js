import Vue from 'vue';
window.Vue = Vue;

// window.Toast = require('vue-toast-mobile').default;
// import Toast from 'v-toast';
// window.Toast = Toast;
/**
 * Require Libraries
 */
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';

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
// Vue.transition('fade', {
//     enterClass: 'fadeIn',
//     leaveClass: 'fadeOut'
// });
// Vue.transition('faderight', {
//     enterClass: 'fadeInRight',
//     leaveClass: 'fadeOutRight'
// });
// Vue.transition('fadeleft', {
//     enterClass: 'fadeInLeft',
//     leaveClass: 'fadeOutLeft'
// });

/**
 * Intercepting the http
*/
Vue.http.interceptors.push(require('./config/interceptors.js'));
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
    'navigation-view': require('./views/NavigationView')
  },

  data() {
        return {
            errors: 5151
        }
    },
    created() {
        console.log("Started")
    }
});

window.router = router;