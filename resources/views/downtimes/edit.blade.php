@push('scripts')

@stop

@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Dowmtimes', 'page_description'=>'Edit Dowmtime.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-warning">
                    <div class="box-header">
                        <h4>
                            Edit Dowmtime
                            <a href="/admin/downtimes/create" class="pull-right" title="Home">
                                 <i class="fa fa-plus"></i> Add
                            </a>
                        </h4>
                    </div>


                    <div class="box-body">
                        {!! Form::model($downtime, ['route'=>['admin.downtimes.update', $downtime->id], 'method'=>'PUT', 'class'=>'', 'role'=>'form', 'novalidate'=>true]) !!}

                            @include('downtimes._form')

                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-2">
                                    <button type="submit" class="btn btn-warning">Update</button>
                                </div>
                            </div>

                        {!! Form::close() !!}
                    </div>

                    <div class="box-footer">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>More Details</h5>
                            </div>
                            <div class="panel-body">
                                <ul class="list-group">
                                    <div class="col-sm-6">
                                        <li class="list-group-item">
                                            <strong>Unique ID: </strong> {{ $downtime->unique_id }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Date: </strong> {{ $downtime->date }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Employee: </strong> {{ optional($downtime->employee)->full_name }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Supervisor: </strong> {{ optional($downtime->supervisor)->name }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Project: </strong> {{ optional(optional($downtime->campaign)->project)->name }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Campaign: </strong> {{ optional($downtime->campaign)->name }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Login Time: </strong> {{ number_format($downtime->login_time, 3) }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Production Time: </strong> {{ number_format($downtime->production_time, 3) }}
                                        </li>
                                    </div>

                                    <div class="col-sm-6">
                                        <li class="list-group-item">
                                            <strong>Talk Time: </strong> {{ number_format($downtime->talk_time, 3) }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Billable Time: </strong> {{ number_format($downtime->billable_hours, 3) }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Calls: </strong> {{ number_format($downtime->calls, 0) }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Contacts: </strong> {{ number_format($downtime->contacts, 0) }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Sales: </strong> {{ number_format($downtime->transactions, 0) }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Revenue: </strong> ${{ number_format($downtime->revenue, 3) }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>SPH Goal: </strong> {{ number_format($downtime->sph_goal, 3) }}
                                        </li>
                                    </div>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <delete-request-button
                            url="{{ route('admin.downtimes.destroy', $downtime->id) }}"
                            redirect-url="{{ route('admin.downtimes.index') }}"
                        ></delete-request-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endpush
