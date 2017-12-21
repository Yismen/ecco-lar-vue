require('./bootstrap/bootstrap.js');

import routes from './app/router/routes.js';

const router = new VueRouter({
    routes,
    saveScrollPosition: true,
    linkActiveClass: 'active',
    'active-class': 'active'
});

import store from './app/stores/Store.js'


new Vue({
 el: '#app',

  router: router,

  components:  require('./app/components/globals/globalComponents.js').default,

  store: new Vuex.Store(store)
  
});

window.router = router;
// window.http = axios;