const routes = [
    {
        name: 'home', path: '/', components: {
            positions: require('./../components/positions/Index')
        }
    },
    {name: 'create-positions', path: '/positions/create', component: require('./../components/positions/Create')}
]

export default routes;