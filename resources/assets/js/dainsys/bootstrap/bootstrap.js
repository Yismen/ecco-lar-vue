import Vue from 'vue';
window.Vue = Vue;

import Vuex from 'vuex';
window.Vuex = Vuex;
Vue.use(Vuex);
new Vuex.Store(require('./../app/stores/Store.js').default)

Vue.config.debug = true // Comment this line for production

import VueResource from 'vue-resource';
Vue.http = VueResource;
Vue.use(VueResource);

import Vue2Filters from 'vue2-filters';
Vue.use(Vue2Filters);


import VueRouter from 'vue-router';
window.VueRouter = VueRouter;
Vue.use(VueRouter);

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('content');
Vue.http.interceptors.push(require('./../app/config/interceptors.js').default);

/**
 * VueC ioc Container.
 * Register binds with Vue.$ioc.register.
 * To pull an item from the ioc use this.$ioc.resolve('Bind')
 */
import Vuec from 'vue-container';
import binds from './binds.js';
Vue.use(Vuec);
Vue.$ioc.register('Form', require('../vendor/dainsys-form').default)
Vue.$ioc.register('Event', require('../vendor/dainsys-event').default)
// Vue.use(Vuec, {
//   register: binds
// });

