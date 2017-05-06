export default [
/**
 * Root Components. You can access these components in the '/' uri by passing
 * the property name to the router-view instance and matching
 * with one of the keys in the components object.
 */
    { 
        path: '/',
        components: {
            default: require('./../components/AppComponent'),
            'home': require('./../components/AppComponent'),
            'escalations': require('./../components/Escalations'),
            // 'employees': require('./../components/EmployeesComponent')
        }
    },
    {path: '/escalations', component: require('./../components/Escalations')},
    {path: '/home', component: require('./../components/AppComponent')},
    // {path: '/employees', component: require('./../components/EmployeesComponent')},
]