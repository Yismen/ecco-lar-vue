const routes = [
    {
        path: '/', components: {
            positions: require('./../components/positions/Index'),
            'blackhawk-de-management': require('./../components/blackhawk/de/management/Dashboard')
        }
    },
    {name: 'create-positions', path: '/positions/create', component: require('./../components/positions/Create')}
]

export default routes;