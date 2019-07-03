@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Performances', 'page_description'=>'Details.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10">
                <div class="box box-info">
                    <div class="box-header">
                        <h4>
                            Details
                            <a href="{{ route('admin.performances.index') }}" class="pull-right">
                                <i class="fa fa-home"></i> List
                            </a>
                        </h4>
                    </div>

                    <div class="box-body">
                        <table class="table table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Employee</th>
                                    <th>Supervisor</th>
                                    <th>Project</th>
                                    <th>Campaign</th>
                                    <th>Login Time</th>
                                    <th>Production Time</th>
                                    <th>Sales</th>
                                    <th>Revenue</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($performances as $performance)
                                    <tr>
                                        <td>
                                            <a href="/admin/performances/{{ $performance->date }}" title="SHOW ONLY DATA FOR THIS DATE">{{ $performance->date }}</a>
                                        </td>
                                        <td>{{ $performance->employee->full_name }}</td>
                                        <td>{{ optional($performance->employee->supervisor)->name }}</td>
                                        <td>
                                            <a href="/admin/performances/{{ $performance->date }}?project={{ optional($performance->campaign->project)->id }}" title="SHOW ONLY DATA FOR THIS DATE AND THIS PROJECT">
                                                {{ optional($performance->campaign->project)->name }}
                                            </a>
                                        </td>
                                        <td>{{ $performance->campaign->name }}</td>
                                        <td>{{ number_format($performance->login_time, 2) }}</td>
                                        <td>{{ number_format($performance->production_time, 2) }}</td>
                                        <td>{{ number_format($performance->transactions, 2) }}</td>
                                        <td>${{ number_format($performance->revenue, 2) }}</td>
                                        <td>
                                            <a href="{{ route('admin.performances.edit', $performance->id) }}" class="text-warning">
                                                <i class="fa fa-pencil"></i> Edit
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="box-footer">
                        {{ $performances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@stop
