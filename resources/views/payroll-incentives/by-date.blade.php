@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Payroll Incentives'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h4>
                            <div class="col-xs-8">Payroll Incentives for Date [{{ date("M/d/Y", strtotime($date)) }}]</div>
                            <div class="col-xs-2">
                                <a href="{{ route('admin.payroll-incentives.index') }}">
                                    <i class="fa fa-dashboard"></i><span class="hidden-sm hidden-xs"> Dashboard</span>
                                </a>
                            </div>
                            <div class="col-xs-2">
                                <a href="{{ route('admin.payroll-incentives.create') }}">
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
                                        <th>Incentive Amount</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($incentives as $incentive)
                                        <tr>
                                            <td>{{ date("M/d/Y", strtotime($incentive->date)) }}</td>
                                            <td>{{ $incentive->employee_id }}</td>
                                            <td>
                                                <a href="{{ route('admin.payroll-incentives.details', [$date, $incentive->employee_id]) }}">{{ $incentive->employee->full_name }}</a>
                                            </td>
                                            <td>{{ $incentive->employee->position->department->name }} - {{ $incentive->employee->position->name }}</td>
                                            <td>${{ number_format($incentive->incentive_amount_sum, 2) }}</td>
                                            <td><a href="{{ route('admin.payroll-incentives.details', [$date, $incentive->employee_id]) }}"><i class="fa fa-eye"></i> Details</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th colspan="4">Totals</th>
                                    <th>${{ number_format($incentives->sum('incentive_amount_sum'), 2) }}</th>
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