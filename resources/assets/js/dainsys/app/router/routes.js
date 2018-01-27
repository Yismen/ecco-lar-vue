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
            sources: require('./../components/sources/SourcesComponent.vue'),
            notes: require('./../components/notes/IndexComponent'),
            escalations_admin: require('./../components/escalations_admin/IndexComponent'),
            payrolls: require('./../components/payrolls/Index')
        }
    },
    {path: '/notes', name: 'notes.index', component: require('./../components/notes/DetailsComponent')},
    {path: '/notes/:id', name: 'notes.show', component: require('./../components/notes/DetailsComponent.vue')},

    {path: '/sources/show/:slug', name: 'show-source', component: require('./../components/sources/ShowSource.vue')},
    {path: '/sources/edit/:slug', name: 'edit-source', component: require('./../components/sources/EditSource.vue')},
    {path: '/sources/create', name: 'create-source', component: require('./../components/sources/CreateSource.vue')},
    {path: '/sources/destroy', name: 'destroy-source', component: require('./../components/sources/DestroySource.vue')},
    
    {path: '/todos', component: require('./../components/todos/TodosComponent')},
    { path: '*', redirect: '/' },
]
