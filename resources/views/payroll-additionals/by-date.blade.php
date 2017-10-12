@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Payroll Additionals'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h4>
                            <div class="col-xs-8">Payroll Additionals for Date [{{ date("M/d/Y", strtotime($date)) }}]</div>
                            <div class="col-xs-2">
                                <a href="{{ route('admin.payroll-additionals.index') }}">
                                    <i class="fa fa-dashboard"></i><span class="hidden-sm hidden-xs"> Dashboard</span>
                                </a>
                            </div>
                            <div class="col-xs-2">
                                <a href="{{ route('admin.payroll-additionals.create') }}">
                                    <i class="fa fa-plus"></i><span class="hidden-sm hidden-xs"> Create</span>
                                </a>
                            </div>
                        </h4>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-condensed table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Project - Position</th>
                                        <th>Additional Amount</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($additionals as $additional)
                                        <tr>
                                            <td>{{ date("M/d/Y", strtotime($additional->date)) }}</td>
                                            <td>{{ $additional->employee_id }}</td>
                                            <td>
                                                <a href="{{ route('admin.payroll-additionals.details', [$date, $additional->employee_id]) }}">{{ $additional->employee->full_name }}</a>
                                            </td>
                                            <td>{{ $additional->employee->position->department->department }} - {{ $additional->employee->position->name }}</td>
                                            <td>${{ number_format($additional->additional_amount_sum, 2) }}</td>
                                            <td><a href="{{ route('admin.payroll-additionals.details', [$date, $additional->employee_id]) }}"><i class="fa fa-eye"></i> Details</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th colspan="4">Totals</th>
                                    <th>${{ number_format($additionals->sum('additional_amount_sum'), 2) }}</th>
                                    <th></th>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="box-footer">
                        {{ $additionals->render() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop