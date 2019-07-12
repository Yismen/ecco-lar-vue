@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Performances Data', 'page_description'=>'description'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header">
                        <h4>
                            Create Performance Data <small>D Only</small>
                            <a href="{{ route('admin.performances.index') }}" class="pull-right" title="Back to List">
                                <i class="fa fa-list"></i> List
                            </a>
                        </h4>
                    </div>

                    <div class="box-body" id="performances-create">

                        {!! Form::open(['route'=>['admin.performances.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'novalidate'=>true]) !!}

                            <!-- Employee -->
                            <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : null }}">
                                {!! Form::label('employee_id', ' Employee:', ['class'=>'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::select('employee_id', $performance->employeeRecentsList->pluck('full_name', 'id'), null, ['class'=>'form-control']) !!}
                                    {!! $errors->first('employee_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <!-- /. Employee -->
                            <!-- Downtime Campaign -->
                            <div class="form-group {{ $errors->has('campaign_id') ? 'has-error' : null }}">
                                {!! Form::label('campaign_id', ' Downtime Campaign:', ['class'=>'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::select('campaign_id', $performance->downtimesCampaignsList->pluck('name', 'id'), null, ['class'=>'form-control']) !!}
                                    {!! $errors->first('campaign_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <!-- /. Downtime Campaign -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- Login Time -->
                                    <div class="form-group {{ $errors->has('login_time') ? 'has-error' : null }}">
                                        {!! Form::label('login_time', ' Login Time:', ['class'=>'col-sm-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            {!! Form::input('number', 'login_time', null, ['step'=>0.05, 'class'=>'form-control', 'placeholder'=>'Login Time']) !!}
                                            {!! $errors->first('login_time', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <!-- /. Login Time -->
                                </div>
                                <div class="col-sm-6">
                                    <!-- Date -->
                                    <div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
                                        {!! Form::label('date', ' Date:', ['class'=>'col-sm-4 control-label']) !!}
                                        <div class="col-sm-8">
                                            {{-- {!! Form::input('text', 'date', null, ['class'=>'form-control', 'placeholder'=>'Date']) !!} --}}
                                            <date-picker
                                                name="date" id="name"
                                                value="{{ old('date') }}"
                                                format="yyyy-MM-dd"
                                                :disable-since-many-days-ago="30"
                                            ></date-picker>
                                            {!! $errors->first('date', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <!-- /. Date -->
                                </div>
                            </div>
                            <!-- Downtime Reason -->
                            <div class="form-group {{ $errors->has('downtime_reason_id') ? 'has-error' : null }}">
                                {!! Form::label('downtime_reason_id', ' Downtime Reason:', ['class'=>'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::select('downtime_reason_id', $performance->downtimesReasonsList->pluck('name', 'id'), null, ['class'=>'form-control']) !!}
                                    {!! $errors->first('downtime_reason_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <!-- /. Downtime Reason -->
                            <!-- Reported By -->
                            <div class="form-group {{ $errors->has('reported_by') ? 'has-error' : null }}">
                                {!! Form::label('reported_by', ' Reported By:', ['class'=>'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::select('reported_by', $performance->activeSupervisorsList->pluck('name', 'name'), null, ['class'=>'form-control']) !!}
                                    {!! $errors->first('reported_by', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
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
                    {{-- .box-body --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@stop
