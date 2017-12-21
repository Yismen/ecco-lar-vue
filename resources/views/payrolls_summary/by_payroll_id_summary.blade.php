@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Payrolls by Payroll ID'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h2>
                            Summary for Payroll ID [{{ $payroll_id }}] 
                            <span class="badge badge-danger">{{ $payroll_summaries->count() }} Records</span> 
                            <a href="{{ route('admin.payrolls_summary.index') }}" class="pull-right"><i class="fa fa-list"></i> List</a>
                        </h2>
                    </div>

                    <div class="box-body">
                        @if ($payroll_summaries->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Payroll ID</th>
                                            <th>Payment Date</th>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Position</th>
                                            <th>Gross Income</th>
                                            <th>TSS Income</th>
                                            <th>Net Income</th>
                                            <th>Payment Income</th>
                                            {{-- <th>Edit</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payroll_summaries as $summary)
                                            <tr>
                                                <td>{{ $summary->payroll_id }}</td>
                                                <td>{{ $summary->payment_date }}</td>
                                                <td>
                                                    <a href="{{ route('admin.payrolls_summary.show', $summary->id) }}">{{ $summary->employee_id }}</a>
                                                </td>
                                                <td><a href="{{ route('admin.payrolls_summary.show', $summary->id) }}">{{ $summary->employee->full_name }}</a></td>
                                                <td>{{ $summary->employee->position->department->department }}</td>
                                                <td>{{ $summary->employee->position->name }}</td>
                                                <td>${{ number_format($summary->gross_incomes, 2) }}</td>
                                                <td>${{ number_format($summary->tss_payroll_incomes, 2) }}</td>
                                                <td>${{ number_format($summary->net_incomes, 2) }}</td>
                                                <td>${{ number_format($summary->payment_incomes, 2) }}</td>
                                                {{-- <td><a href="{{ route('admin.payrolls_summary.edit', $summary->id) }}"><i class="fa fa-edit"></i> Edit</a></td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <strong>Atention!</strong> Nothing found for this payroll id [{{ $payroll_id }}]!
                            </div>
                        @endif
                    </div>

                    <div class="box-footer"></div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop