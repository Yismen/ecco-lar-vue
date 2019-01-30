@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Hours By Date'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4>
                            <div class="col-xs-8">Hours for Date [{{ $date }}]</div>
                            <div class="col-xs-2">
                                <a href="{{ route('admin.hours.index') }}">
                                    <i class="fa fa-dashboard"></i><span class="hidden-sm hidden-xs"> Dashboard</span>
                                </a>
                            </div>
                            <div class="col-xs-2">
                                <a href="{{ route('admin.hours-import.index') }}">
                                    <i class="fa fa-upload"></i><span class="hidden-sm hidden-xs"> Import</span>
                                </a>
                            </div>
                        </h4>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Project - Position</th>
                                        <th>Regulars</th>
                                        <th>Nightly</th>
                                        <th>Holidays</th>
                                        <th>Training</th>
                                        <th>Overtime</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hours as $hour)
                                        <tr>
                                            <td>{{ $hour->date->format("M-d-Y") }}</td>
                                            <td>{{ $hour->employee_id }}</td>
                                            <td>{{ $hour->employee->full_name }}</td>
                                            <td>{{ $hour->employee->position->department->name }} - {{ $hour->employee->position->name }}</td>
                                            <td>{{ number_format($hour->regulars, 2) }}</td>
                                            <td>{{ number_format($hour->nightly, 2) }}</td>
                                            <td>{{ number_format($hour->holidays, 2) }}</td>
                                            <td>{{ number_format($hour->training, 2) }}</td>
                                            <td>{{ number_format($hour->overtime, 2) }}</td>
                                            <td><a href="{{ route('admin.hours.edit', $hour->id) }}"><i class="fa fa-edit"></i> Edit</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th colspan="4">Totals</th>
                                    <th>{{ number_format($hours->sum('regulars'), 2) }}</th>
                                    <th>{{ number_format($hours->sum('nightly'), 2) }}</th>
                                    <th>{{ number_format($hours->sum('holidays'), 2) }}</th>
                                    <th>{{ number_format($hours->sum('training'), 2) }}</th>
                                    <th>{{ number_format($hours->sum('overtime'), 2) }}</th>
                                    <th></th>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="box-footer">
                        {{ $hours->render() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop