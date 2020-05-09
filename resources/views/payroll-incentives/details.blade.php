@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Payroll Incentives'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h4>
                            <div class="col-xs-8">
                                Payroll Incentives Details
                            </div>
                            <div class="col-xs-2">
                                <a href="{{ route('admin.payroll-incentives.index') }}">
                                    <i class="fa fa-dashboard"></i><span class="hidden-sm hidden-xs"> Dashboard</span>
                                </a>
                            </div>
                            <div class="col-xs-2">
                                <a href="{{ route('admin.payroll-incentives.by-date', [date("Y-m-d", strtotime($date))]) }}">
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
                                        <th>Incentive Amount</th>
                                        <th>Concept</th>
                                        <th>Comments</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($incentives as $incentive)
                                        <tr>
                                            <td>{{ date("M/d/Y", strtotime($incentive->date)) }} </td>
                                            <td>{{ $incentive->employee_id }}</td>
                                            <td>{{ $incentive->employee->full_name }}</td>
                                            <td>${{ number_format($incentive->incentive_amount, 2) }}</td>
                                            <td>{{ $incentive->concept->name }}</td>
                                            <td>{{ $incentive->comment }}</td>
                                            <td><a href="{{ route('admin.payroll-incentives.edit', $incentive->id) }}"><i class="fa fa-edit"></i> Edit</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th colspan="3">Totals</th>
                                    <th>${{ number_format($incentives->sum('incentive_amount'), 2) }}</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="box-footer">
                        {{ $incentives->render() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush