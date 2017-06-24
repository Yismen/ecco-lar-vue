import Vue from 'vue';
window.Vue = Vue;

Vue.config.debug = true // Comment this line for production

// Vue.http.interceptors.request.use(function(config){
//     config.headers['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('content');
//     return config;
// })

/**
 * Libraries to use. These libraries are added as part of the constructor.
 * Whithin the instance they can be referenced with the 'this' key.
 */

/**
 * Configuration session
 */

import VueResource from 'vue-resource';
// Vue.http = VueResource;
Vue.use(VueResource);

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('content');
Vue.http.interceptors.push(require('./config/interceptors.js'));

Vue.http.get('/admin/employees');

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

  filters: {
    sortByProperties(obj) {
      
      // convert object into array
      var sortable=[];
      for(var key in obj)
        if(obj.hasOwnProperty(key))
          sortable.push([key, obj[key]]); // each item is an array in format [key, value]
      
      // sort items by value
      sortable.sort(function(a, b)
      {
        var x=a[1].toLowerCase(),
          y=b[1].toLowerCase();
        return x<y ? -1 : x>y ? 1 : 0;
      });
      return sortable; // array in format [ [ key1, val1 ], [ key2, val2 ], ... ]
    
    }
  },

  methods: {
    sortProperties(obj) {
      // convert object into array
      var sortable=[];
      for(var key in obj)
        if(obj.hasOwnProperty(key))
          sortable.push([key, obj[key]]); // each item is an array in format [key, value]
      
      // sort items by value
      sortable.sort(function(a, b)
      {
        var x=a[1].toLowerCase(),
          y=b[1].toLowerCase();
        return x<y ? -1 : x>y ? 1 : 0;
      });
      return sortable; // array in format [ [ key1, val1 ], [ key2, val2 ], ... ]
    }
  },

  components:  require('./components/globals/globalComponents.js').default,

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