@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Payroll Additionals'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h4>
                            <div class="col-xs-8">
                                Payroll Additionals Details
                            </div>
                            <div class="col-xs-2">
                                <a href="{{ route('admin.payroll-additionals.index') }}">
                                    <i class="fa fa-dashboard"></i><span class="hidden-sm hidden-xs"> Dashboard</span>
                                </a>
                            </div>
                            <div class="col-xs-2">
                                <a href="{{ route('admin.payroll-additionals.by-date', [date("Y-m-d", strtotime($date))]) }}">
                                    <i class="fa fa-angle-double-left"></i> 
                                    Back
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
                                        <th>Additional Amount</th>
                                        <th>Concept</th>
                                        <th>Comments</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($additionals as $additional)
                                        <tr>
                                            <td>{{ date("M/d/Y", strtotime($additional->date)) }} </td>
                                            <td>{{ $additional->employee_id }}</td>
                                            <td>{{ $additional->employee->full_name }}</td>
                                            <td>${{ number_format($additional->additional_amount, 2) }}</td>
                                            <td>{{ $additional->concept->name }}</td>
                                            <td>{{ $additional->comment }}</td>
                                            <td><a href="{{ route('admin.payroll-additionals.edit', $additional->id) }}"><i class="fa fa-edit"></i> Edit</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th colspan="3">Totals</th>
                                    <th>${{ number_format($additionals->sum('additional_amount'), 2) }}</th>
                                    <th></th>
                                    <th></th>
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
@push('scripts')

@endpush