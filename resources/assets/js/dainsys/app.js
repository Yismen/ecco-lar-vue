require('./bootstrap/bootstrap.js');

import routes from './app/router/routes.js';

const router = new VueRouter({
    routes,
    saveScrollPosition: true,
    linkActiveClass: 'active',
    'active-class': 'active'
});

import store from './app/stores/Store.js'
import Components from './app/components/globals/globalComponents.js';

new Vue({
 el: '#app',

  router: router,

    components: Components,

  store: new Vuex.Store(store)
  
});
