@include('dashboards.human_resources._doughnut_chart', [
    'title' => 'HC By Sites',
    'data_key' => 'by_site',
    'link_route' => route('admin.sites.index')
])

@include('dashboards.human_resources._doughnut_chart', [
    'title' => 'HC By Projects',
    'data_key' => 'by_project',
    'link_route' => route('admin.projects.index')
])

@include('dashboards.human_resources._doughnut_chart', [
    'title' => 'HC By Gender',
    'data_key' => 'by_gender',
    'link_route' => "#"
])

@include('dashboards.human_resources._doughnut_chart', [
    'title' => 'HC By Departments',
    'data_key' => 'by_department',
    'link_route' => route('admin.departments.index')
])

@include('dashboards.human_resources._doughnut_chart', [
    'title' => 'HC By Positions',
    'data_key' => 'by_position',
    'link_route' => route('admin.positions.index')
])

@include('dashboards.human_resources._doughnut_chart', [
    'title' => 'HC By Supervisors',
    'data_key' => 'by_supervisor',
    'link_route' => route('admin.supervisors.index')
])

@include('dashboards.human_resources._doughnut_chart', [
    'title' => 'HC By Nationality',
    'data_key' => 'by_nationality',
    'link_route' => route('admin.nationalities.index')
])