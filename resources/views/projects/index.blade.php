@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Sources', 'page_description'=>'List of projects of production.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4>
                            Projects List
                            <a href="{{ route('admin.projects.create') }}" class="pull-right">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </h4>
                    </div>
                    {{-- .box-header --}}
                    <div class="box-body">
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="col-xs-2">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.projects.show', $project->id) }}">{{ $project->name }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="text-warning">
                                                <i class="fa fa-pencil"></i> Edit
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                   </div>
                   {{-- .box-body --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@stop