export default [
/**
 * Root Components. You can access these components in the '/' uri by passing
 * the property name to the router-view instance and matching
 * with one of the keys in the components object.
 */
    { 
        path: '/',
        components: {
            // default: require('./../components/AppComponent'),
            sources: require('./../components/sources/SourcesComponent.vue'),
            test: require('./../components/AddTest'),
            pagination: require('./../components/test/Pagination.vue')
            // 'employees': require('./../components/EmployeesComponent')
        }
    },
    {path: '/sources/show/:slug', name: 'show-source', component: require('./../components/sources/ShowSource.vue')},
    {path: '/sources/edit/:slug', name: 'edit-source', component: require('./../components/sources/EditSource.vue')},
    {path: '/sources/create', name: 'create-source', component: require('./../components/sources/CreateSource.vue')},
    {path: '/sources/destroy', name: 'destroy-source', component: require('./../components/sources/DestroySource.vue')},
    
    {path: '/home', component: require('./../components/AppComponent')},
    {path: '/todos', component: require('./../components/todos/TodosComponent')},
    {path: '/add-test', component: require('./../components/AddTest')},
    // {path: '/employees', component: require('./../components/EmployeesComponent')},
]
