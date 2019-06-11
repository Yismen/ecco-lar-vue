@section('scripts')

@stop

@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Performances', 'page_description'=>'Edit Performance.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-warning">
                    <div class="box-header">
                        <h4>
                            Edit Performance
                            <a href="/admin/performances" class="pull-right" title="Back to the list">
                                <i class="fa fa-list"></i>
                                All
                            </a>
                        </h4>
                    </div>


                    <div class="box-body">
                        {!! Form::model($performance, ['route'=>['admin.performances.update', $performance->id], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}

                            @include('performances._form')

                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-2">
                                    <button type="submit" class="btn btn-warning">Update</button>
                                </div>
                            </div>

                        {!! Form::close() !!}
                    </div>

                    <div class="box-footer">
                        <delete-request-button
                            url="{{ route('admin.performances.destroy', $performance->id) }}"
                            redirect-url="{{ url()->previous() }}"
                        ></delete-request-button>
                    </div>

                    <div class="box-footer">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>More Details</h5>
                            </div>
                            <div class="panel-body">
                                <ul class="list-group">
                                    <li class="col-sm-6 col-md-4 list-group-item">
                                        <strong>Unique ID: </strong> {{ $performance->unique_id }}
                                    </li>

                                    <li class="col-sm-6 col-md-4 list-group-item">
                                        <strong>Date: </strong> {{ $performance->date }}
                                    </li>

                                    <li class="col-sm-6 col-md-4 list-group-item">
                                        <strong>Employee: </strong> {{ optional($performance->employee)->full_name }}
                                    </li>

                                    <li class="col-sm-6 col-md-4 list-group-item">
                                        <strong>Supervisor: </strong> {{ optional($performance->supervisor)->name }}
                                    </li>

                                    <li class="col-sm-6 col-md-4 list-group-item">
                                        <strong>Project: </strong> {{ optional($performance->campaign->project)->name }}
                                    </li>

                                    <li class="col-sm-6 col-md-4 list-group-item">
                                        <strong>Campaign: </strong> {{ optional($performance->campaign)->name }}
                                    </li>

                                    <li class="col-sm-6 col-md-4 list-group-item">
                                        <strong>Login Time: </strong> {{ $performance->login_time }}
                                    </li>

                                    <li class="col-sm-6 col-md-4 list-group-item">
                                        <strong>Production Time: </strong> {{ $performance->production_time }}
                                    </li>

                                    <li class="col-sm-6 col-md-4 list-group-item">
                                        <strong>Talk Time: </strong> {{ $performance->talk_time }}
                                    </li>

                                    <li class="col-sm-6 col-md-4 list-group-item">
                                        <strong>Billable Time: </strong> {{ $performance->billable_hours }}
                                    </li>

                                    <li class="col-sm-6 col-md-4 list-group-item">
                                        <strong>Calls: </strong> {{ $performance->calls }}
                                    </li>

                                    <li class="col-sm-6 col-md-4 list-group-item">
                                        <strong>Contacts: </strong> {{ $performance->contacts }}
                                    </li>

                                    <li class="col-sm-6 col-md-4 list-group-item">
                                        <strong>Sales: </strong> {{ $performance->transactions }}
                                    </li>

                                    <li class="col-sm-6 col-md-4 list-group-item">
                                        <strong>Revenue: </strong> {{ $performance->revenue }}
                                    </li>

                                    <li class="col-sm-6 col-md-4 list-group-item">
                                        <strong>SPH Goal: </strong> {{ $performance->sph_goal }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop
