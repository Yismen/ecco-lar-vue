@push('scripts')

@stop

@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Performances', 'page_description'=>'Edit Performance.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-warning">
                    <div class="box-header">
                        <h4>
                            Edit Performance
                            <a href="{{ route('admin.performances.show', $performance->id) }}" title="Show Details">
                                 <i class="fa fa-eye"></i>
                            </a>
                            <a href="/admin/performances" class="pull-right" title="Back to the list">
                                 <i class="fa fa-list"></i> List
                            </a>
                        </h4>
                    </div>


                    <div class="box-body">
                        {!! Form::model($performance, ['route'=>['admin.performances.update', $performance->id], 'method'=>'PUT', 'class'=>'', 'role'=>'form', 'novalidate'=>true]) !!}

                            @include('performances._form')

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
                                            <strong>Unique ID: </strong> {{ $performance->unique_id }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Date: </strong> {{ $performance->date }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Employee: </strong> {{ optional($performance->employee)->full_name }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Supervisor: </strong> {{ optional($performance->supervisor)->name }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Project: </strong> {{ optional($performance->campaign->project)->name }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Campaign: </strong> {{ optional($performance->campaign)->name }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Login Time: </strong> {{ number_format($performance->login_time, 3) }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Production Time: </strong> {{ number_format($performance->production_time, 3) }}
                                        </li>
                                    </div>

                                    <div class="col-sm-6">
                                        <li class="list-group-item">
                                            <strong>Talk Time: </strong> {{ number_format($performance->talk_time, 3) }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Billable Time: </strong> {{ number_format($performance->billable_hours, 3) }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Calls: </strong> {{ number_format($performance->calls, 0) }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Contacts: </strong> {{ number_format($performance->contacts, 0) }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Sales: </strong> {{ number_format($performance->transactions, 0) }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>Revenue: </strong> ${{ number_format($performance->revenue, 3) }}
                                        </li>

                                        <li class="list-group-item">
                                            <strong>SPH Goal: </strong> {{ number_format($performance->sph_goal, 3) }}
                                        </li>
                                    </div>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <delete-request-button
                            url="{{ route('admin.performances.destroy', $performance->id) }}"
                            redirect-url="{{ route('admin.performances.index') }}"
                        ></delete-request-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endpush
