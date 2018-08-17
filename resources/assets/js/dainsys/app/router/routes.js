import Note from './../components/notes/DetailsComponent';

export default [
/**
 * Root Components. You can access these components in the '/' uri by passing
 * the property name to the router-view instance and matching
 * with one of the keys in the components object.
 */
    { 
        path: '/',
        components: {
            sources: require('./../components/sources/SourcesComponent.vue').default,
            notes: require('./../components/notes/IndexComponent').default,
            escalations_admin: require('./../components/escalations_admin/IndexComponent').default,
            payrolls: require('./../components/payrolls/Index').default,
            'blackhawk-cs-management': require('./../components/blackhawk-cs/management/Index').default,
            'blackhawk-cs-supervisor': require('./../components/blackhawk-cs/supervisor/Index').default
        }
    },
    {path: '/notes', name: 'notes.index', component: require('./../components/notes/DetailsComponent').default},
    {path: '/notes/:id', name: 'notes.show', component: require('./../components/notes/DetailsComponent.vue').default},

    {path: '/sources/show/:slug', name: 'show-source', component: require('./../components/sources/ShowSource.vue').default},
    {path: '/sources/edit/:slug', name: 'edit-source', component: require('./../components/sources/EditSource.vue').default},
    {path: '/sources/create', name: 'create-source', component: require('./../components/sources/CreateSource.vue').default},
    {path: '/sources/destroy', name: 'destroy-source', component: require('./../components/sources/DestroySource.vue').default},
    
    {path: '/todos', component: require('./../components/todos/TodosComponent').default},
    { path: '*', redirect: '/' },
]
