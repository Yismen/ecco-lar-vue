var Vue = require('vue');
window.Vue = Vue;
/**
 * Required Components 
 */
import MenuComponent from './components/Menu.vue';
import TaskComponent from './components/Task.vue';
// Vue.component('mymenu', MenuComponent);

/**
 * Require Libraries
 */
var VueRouter = require('vue-router');
var VueResource = require('vue-resource');
// var progress = require('vue-progressbar');
// var progress = require('./app.js');

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
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('value');

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

/**
 * Vue Router configuration
 */
var App = Vue.extend({
    data() {
        return {
            somedata: 'Some dummy data'
        }
    },
    components: {
        mymenu: MenuComponent
    }
});

var router = new VueRouter();
router.map({
    '/': {component: require('./components/Employee.vue')},
    '/notes': {component: require('./components/notes/Note.vue')},
    '/notes/admin': {component: require('./components/notes/Note_admin.vue')},
    '/tasks/create': {component: require('./components/tasks/Create.vue')},
    '/tasks': {component: TaskComponent},
});

router.start(App, 'body');