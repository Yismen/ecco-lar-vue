@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Payroll Discounts'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h4>
                            <div class="col-xs-8">Payroll Discounts for Date [{{ date("M/d/Y", strtotime($date)) }}]</div>
                            <div class="col-xs-2">
                                <a href="{{ route('admin.payroll-discounts.index') }}">
                                    <i class="fa fa-dashboard"></i><span class="hidden-sm hidden-xs"> Dashboard</span>
                                </a>
                            </div>
                            <div class="col-xs-2">
                                <a href="{{ route('admin.payroll-discounts.create') }}">
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
                                        <th>Discount</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($discounts as $discount)
                                        <tr>
                                            <td>{{ date("M/d/Y", strtotime($discount->date)) }}</td>
                                            <td>{{ $discount->employee_id }}</td>
                                            <td><a href="{{ route('admin.payroll-discounts.details', [$date, $discount->employee_id]) }}">{{ $discount->employee->full_name }}</a></td>
                                            <td>{{ $discount->employee->position->department->name }} - {{ $discount->employee->position->name }}</td>
                                            <td>${{ number_format($discount->discount_amount_sum, 2) }}</td>
                                            <td><a href="{{ route('admin.payroll-discounts.details', [$date, $discount->employee_id]) }}"><i class="fa fa-eye"></i> Details</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th colspan="4">Totals</th>
                                    <th>${{ number_format($discounts->sum('discount_amount_sum'), 2) }}</th>
                                    <th></th>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="box-footer">
                        {{ $discounts->render() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop