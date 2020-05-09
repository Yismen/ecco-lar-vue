@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Payments', 'page_description'=>'Details for Payment Type'])

@section('content')
	<div class="container-fluid">
		<div class="col-sm-8 col-sm-offset-2">

            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-info">
                        <div class="col-sm-12">
                            <h3>
                                Payroll Details
                                <a href="{{ URL::previous() }}" class="pull-right"><i class="fa fa-arrow-left"></i> Return</a>
                            </h3>
                        </div>
                        <table class="table table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Personal ID or Passport</th>
                                    <th>Position</th>
                                    <th>Bank Account</th>
                                    <th>Payroll ID</th>
                                    <th>Payment Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $summary->employee->id }}</td>
                                    <td>{{ $summary->employee->full_name }}</td>
                                    <td>{{ $summary->employee->personal_id or $summary->employee->passport }}</td>
                                    <td>
                                        {{ $summary->employee->position->name }}, At
                                        {{ $summary->employee->position->department->name }}
                                    </td>
                                    <td>{{ $summary->employee->bankAccount->account_number or null }}</td>
                                    <td>{{ $summary->payroll_id }}</td>
                                    <td>{{ $summary->payment_date }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

			<div class="row">
                <div class="col-sm-4">
                    <div class="box box-success">
                        <table class="table table-condensed table-bordered">
                            <thead><h4>Incomes</h4></thead>
                            <tbody>
                                <tr>
                                    <th>Gross Income</th>
                                    <td>${{ number_format($summary->gross_incomes, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Net Income</th>
                                    <td>${{ number_format($summary->net_incomes, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Income</th>
                                    <td>${{ number_format($summary->payment_incomes, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>TSS Payroll</th>
                                    <td>${{ number_format($summary->tss_payroll_incomes, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="box box-info">
                        <table class="table table-condensed table-bordered">
                            <thead><h4>Incomes Details</h4></thead>
                            <tbody>
                                <tr>
                                    <th>Regular Hours Incomes</th>
                                    <td>${{ number_format($summary->regular_incomes, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Nightly Incomes</th>
                                    <td>${{ number_format($summary->nightly_incomes, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Holiday Incomes</th>
                                    <td>${{ number_format($summary->holidays_incomes, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Overtime Incomes</th>
                                    <td>${{ number_format($summary->overtime_incomes, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Training Incomes</th>
                                    <td>${{ number_format($summary->training_incomes, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Incentives Incomes</th>
                                    <td>${{ number_format($summary->incentive_incomes, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Other Incomes</th>
                                    <td>${{ number_format($summary->other_incomes, 2) }}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Totals</th>
                                    <th>${{ number_format(
                                           $summary->regular_incomes +
                                           $summary->nightly_incomes +
                                           $summary->holidays_incomes +
                                           $summary->overtime_incomes +
                                           $summary->training_incomes +
                                           $summary->incentive_incomes +
                                           $summary->other_incomes
                                    , 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="box box-danger">
                        <table class="table table-condensed table-bordered">
                            <thead><h4>Discounts</h4></thead>
                            <tbody>
                                <tr>
                                    <th>ARS Discounts</th>
                                    <td>${{ number_format($summary->ars_discounts, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>AFP Discounts</th>
                                    <td>${{ number_format($summary->afp_discounts, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Other Discounts</th>
                                    <td>${{ number_format($summary->other_discounts, 2) }}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total Discounts</th>
                                    <th>${{ number_format(
                                           $summary->ars_discounts +
                                           $summary->afp_discounts +
                                           $summary->other_discounts
                                    , 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

		</div>
	</div>
@endsection
@push('scripts')

@endpush