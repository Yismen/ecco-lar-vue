@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Departments', 'page_description'=>'List of departments available.'])

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4>
                        Departments
                        <a href="{{ route('admin.departments.create') }}" class="pull-right">
                            <i class="fa fa-plus"></i> Add
                        </a>
                    </h4>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-condensed table-d table-hover" id="description">
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            {{-- Datatables will render this --}}
                            <tbody>
                                @foreach ($departments as $department)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.departments.show', $department->id) }}">
                                                {{ $department->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.departments.edit', $department->id) }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- {{ $departments }} --}}
            </div>
        </div>
    </div>
@stop

@section('scripts')
@stop