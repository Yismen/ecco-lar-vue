@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Performances Data', 'page_description'=>'description'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-primary">
                    <div class="box-header">
                        <h4>
                            Create Performance Data <small>D Only</small>
                            <a href="{{ route('admin.performances.index') }}" class="pull-right" title="Back to List">
                                <i class="fa fa-list"></i> List
                            </a>
                        </h4>
                    </div>

                    {!! Form::open(['route'=>['admin.performances.store'], 'method'=>'POST', 'class'=>'', 'role'=>'form', 'novalidate'=>true]) !!}
                        <div class="box-body" id="performances-create">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : null }}">
                                        {!! Form::label('employee_id', ' Employee:', ['class'=>'']) !!}
                                        {!! Form::select('employee_id', $performance->employeeRecentsList->pluck('full_name', 'id'), null, ['class'=>'form-control', 'placeholder' => '--Select One']) !!}
                                        {!! $errors->first('employee_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <!-- /Employee -->
                                <div class="col-sm-4">
                                    <div class="form-group {{ $errors->has('campaign_id') ? 'has-error' : null }}">
                                        {!! Form::label('campaign_id', ' Downtime Campaign:', ['class'=>'']) !!}
                                        {!! Form::select('campaign_id', $performance->downtimesCampaignsList->pluck('name', 'id'), null, ['class'=>'form-control', 'placeholder' => '--Select One']) !!}
                                    </div>
                                </div>
                                <!-- /Downtime Campaign -->

                                {{-- Login Time --}}
                                <div class="col-sm-4">
                                    <div class="form-group {{ $errors->has('login_time') ? 'has-error' : null }}">
                                        {!! Form::label('login_time', ' Login Time:', ['class'=>'']) !!}
                                        {!! Form::input('number', 'login_time', null, ['step'=>0.05, 'class'=>'form-control', 'placeholder'=>'Login Time']) !!}
                                        {!! $errors->first('login_time', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                                {{-- /. Login Time --}}
                            </div>
                            {{-- /.row --}}
                            <div class="row">
                                <div class="col-sm-4">
                                    <!-- Date -->
                                    <div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
                                        {!! Form::label('date', ' Date:', ['class'=>'']) !!}
                                        {{-- {!! Form::input('text', 'date', null, ['class'=>'form-control', 'placeholder'=>'Date']) !!} --}}
                                        <date-picker
                                            name="date" id="name"
                                            value="{{ old('date') }}"
                                            format="yyyy-MM-dd"
                                            :disable-since-many-days-ago="30"
                                        ></date-picker>
                                        {!! $errors->first('date', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    {{-- /. Date --}}
                                </div>
                                <!-- Downtime Reason -->
                                <div class="col-sm-4">
                                    <div class="form-group {{ $errors->has('downtime_reason_id') ? 'has-error' : null }}">
                                        {!! Form::label('downtime_reason_id', ' Downtime Reason:', ['class'=>'']) !!}
                                        {!! Form::select('downtime_reason_id', $performance->downtimesReasonsList->pluck('name', 'id')->toArray(), null, ['class'=>'form-control', 'placeholder' => '--Select One']) !!}
                                        {!! $errors->first('downtime_reason_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <!-- /. Downtime Reason -->
                                <!-- Reported By -->
                                <div class="col-sm-4">
                                    <div class="form-group {{ $errors->has('reported_by') ? 'has-error' : null }}">
                                        {!! Form::label('reported_by', ' Reported By:', ['class'=>'']) !!}
                                        {!! Form::select('reported_by', $performance->activeSupervisorsList->pluck('name', 'name')->toArray(), null, ['class'=>'form-control', 'placeholder' => '--Select One']) !!}
                                        {!! $errors->first('reported_by', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            {{-- .row --}}
                        </div>
                        {{-- .box-body --}}
                        <!-- /. Reported By -->
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-offset-2">
                                    <button class="btn btn-warning" type="submit">CREATE</button>
                                </div>
                            </div>
                        </div>
                        {{-- .box-footer --}}
                    {!! Form::close() !!}
                </div>

                <div class="box box-info">
                    <div class="box-header">
                        <h4>Recently Created</h4>
                    </div>

                    <div class="box-body">
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Project / Campaign</th>
                                    <th>Login Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recents as $performance)
                                    <tr>
                                        <td>{{ optional($performance->employee)->full_name }}</td>
                                        <td>{{ $performance->date }}</td>
                                        <td>
                                            {{ optional(optional($performance->campaign)->project)->name }} /
                                            {{ optional($performance->campaign)->name }}
                                        </td>
                                        <td>{{ $performance->login_time }}</td>
                                        <td>
                                            <a href="{{ route('admin.performances.edit', $performance->id) }}" class="text-warning" target="_performance">
                                                <i class="fa fa-pencil"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@stop
