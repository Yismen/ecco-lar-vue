@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Employees\' Head Count', 'page_description'=>'Active employees Head Count By Positions'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-primary">

                    <div class="box-header">
                        <h4>
                            Position: {{ $position->name }} 
                            <span class="badge text-centered">{{ $position->employees->count() }} Active Employees</span>

                            <a href="/admin/human_resources" class="pull-right">
                                <i class="fa fa-dashboard"></i>
                                <span class="visible-md visible-lg"> Back to Home</span>
                            </a>
                        </h4>
                    </div>
                    <div class="box-body">
                        @if (! $position->employees)
                            <div class="alert alert-info">
                                <strong>None</strong> No Birthdays In {{ $title }} ...
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="col-xs-1">Photo</th>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Project - Position</th>
                                            <th>Hire Date</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($position->employees as $employee)
                                            <tr>
                                                <td>
                                                    <a href="{{ $employee->photo }}" target="_blank">
                                                        <img src="{{ $employee->photo }}" class="img-responsive img-circle" alt="Image">
                                                    </a>
                                                </td>
                                                <td>{{ $employee->id }}</td>
                                                <td>
                                                    <a href="/admin/employees/{{ $employee->id }}" target="">
                                                        <i class="fa fa-eye"></i> {{ $employee->full_name }}
                                                    </a>
                                                </td>
                                                <td>{{ $employee->position->department->department }} - {{ $employee->position->name }}</td>
                                                <td>{{ $employee->hire_date->format('d/M/Y') }}, {{ $employee->hire_date->diffForHumans() }}</td>
                                                <td>
                                                    <a href="/admin/employees/{{ $employee->id }}/edit"><i class="fa fa-edit"></i> Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop