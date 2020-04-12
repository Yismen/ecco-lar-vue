@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Departments', 'page_description'=>'List of departments available.'])

@section('content')
    @can('view-dashboardds')
        Can
    @endcan
    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo deleniti consequuntur numquam delectus quo commodi quis,
         incidunt reprehenderit, accusantium fugit voluptates? Tempora similique, blanditiis repudiandae quos vitae veniam laborum alias?
    </p>
@stop

@section('scripts')
@stop