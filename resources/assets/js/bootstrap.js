window.Vue = require('vue');
window.Popper = require('popper.js').default;

/**
* Dependencies Management with vue-comtainer
* Usage: Vue.$ioc.register('Axios', Axios); to Register or this.$ioc.resolve('Axios'); to resolve de dependency
* Documentation: Vue.$ioc.register('Axios', Axios);
*/
import Vuec from 'vue-container';
Vue.use(Vuec);
Vue.$ioc.register('Form', require('./vendor/dainsys-form').default);
import Datepicker from 'vuejs-datepicker'
Vue.$ioc.register('Datepicker', Datepicker);

/**
 * Register Sweet Alert (sweetalert) globally.
 * Usage: this.$swal('Heading', 'Message', 'success|info|warning|error|question')
 * Documentation: https://sweetalert2.github.io/#examples
 */
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */
try {
    window.$ = window.jQuery = require('jquery');
    window._ = require('lodash');
    window.moment = require('moment');
    window.Form = require('./vendor/dainsys-form').default
    require('bootstrap');
    require('datatables.net-bs');
    require('admin-lte');
    // require('select2');
    require('./dainsysJQuery')
} catch (e) { console.log(e) }

/**
 * Vue Modal.
 * Usage: <modal name="hello-world">hello, world!</modal>
 * Documentation: https://www.npmjs.com/package/vue-js-modal
 */
import VModal from 'vue-js-modal'
Vue.use(VModal)

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
require('./config/interceptors')

/**
* Here global components are registered
*/
Vue.component('dainsys-logo', require('./components/DainsysLogo.vue').default);
Vue.component('back-to-top', require('./components/BackToTop').default);
Vue.component('loading-component', require('./components/LoadingComponent.vue').default);
Vue.component('passport-clients', require('./components/passport/Clients.vue').default);
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue').default);
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue').default);
Vue.component('positions-select', require('./components/positions/SelectList').default)
Vue.component('departments-select', require('./components/selects/Departments').default)
// Vue.component('create-position', require('./components/employees/positions/Create').default)
// Vue.component('modal', require('./components/Modal').default)
Vue.component('add-button', require('./components/links/AddButton').default)
Vue.component('delete-request-button', require('./components/DeleteRequest').default)
Vue.component('create-afp-form', require('./components/forms/CreateAfp').default)
Vue.component('flash-message', require('./components/FlashMessage').default)
Vue.component('edit-employee', require('./components/employees/Edit').default);
Vue.component('create-employee', require('./components/employees/CreateEmployee').default);

Vue.component('employee-row', require('./components/employees/partials/RowCheckBox').default);
Vue.component('employee-check-box', require('./components/employees/partials/DinamicCheckbox').default);

Vue.component('dropzone-form', require('./components/DropzoneForm').default);

Vue.component('headcounts', require('./components/human_resources/HeadCountsComponent').default);
Vue.component('hc-rotations', require('./components/human_resources/RotationsComponent').default);

Vue.component('sites-metric', require('./components/dashboards/SitesOverview').default);
Vue.component('sites-sph', require('./components/dashboards/sites/Sph').default);



Vue.component('monthly-rotation', require('./components/human_resources/MonthlyRotation').default);
Vue.component('monthly-attrition', require('./components/human_resources/MonthlyAttrition').default);

Vue.component('animation-scale', require('./components/animations/ScaleComponent').default);

Vue.component('date-picker', require('./components/DatePicker').default);
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */


// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
