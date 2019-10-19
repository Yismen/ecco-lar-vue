
<div class="col-xs-12 col-sm-6 col-md-4">
    <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : null }}">
        {!! Form::label('employee_id', ' Employee:', ['class'=>'']) !!}
        {!! Form::select('employee_id', $downtime->employeeRecentsList->pluck('full_name', 'id'), null, ['class'=>'form-control', 'placeholder' => '--Select One']) !!}
        {!! $errors->first('employee_id', '<span class="text-danger">:message</span>') !!}
    </div>
</div>
<!-- /Employee -->
<div class="col-xs-12 col-sm-6 col-md-4">
    <div class="form-group {{ $errors->has('campaign_id') ? 'has-error' : null }}">
        {!! Form::label('campaign_id', ' Downtime Campaign:', ['class'=>'']) !!}
        {!! Form::select('campaign_id', $downtime->downtimesCampaignsList->pluck('name', 'id'), null, ['class'=>'form-control', 'placeholder' => '--Select One']) !!}
    </div>
</div>
<!-- /Downtime Campaign -->


<div class="col-xs-6 col-sm-6 col-md-4">
    <!-- Date -->
    <div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
        {!! Form::label('date', ' Date:', ['class'=>'']) !!}
        {{-- {!! Form::input('text', 'date', null, ['class'=>'form-control', 'placeholder'=>'Date']) !!} --}}
        <date-picker
            name="date" id="name"
            value="{{ $downtime->date ?? old('date') }}"
            format="yyyy-MM-dd"
            :disable-since-many-days-ago="30"
        ></date-picker>
        {!! $errors->first('date', '<span class="text-danger">:message</span>') !!}
    </div>
    {{-- /. Date --}}
</div>

{{-- Downtime --}}
<div class="col-xs-6 col-sm-6 col-md-4">
    <div class="form-group {{ $errors->has('login_time') ? 'has-error' : null }}">
        {!! Form::label('login_time', ' Downtime:', ['class'=>'']) !!}
        {!! Form::input('number', 'login_time', null, ['step'=>0.05, 'class'=>'form-control', 'placeholder'=>'Downtime']) !!}
        {!! $errors->first('login_time', '<span class="text-danger">:message</span>') !!}
    </div>
</div>
{{-- /. Downtime --}}

<!-- Downtime Reason -->
<div class="col-xs-12 col-sm-6 col-md-4">
    <div class="form-group {{ $errors->has('downtime_reason_id') ? 'has-error' : null }}">
        {!! Form::label('downtime_reason_id', ' Downtime Reason:', ['class'=>'']) !!}
        {!! Form::select('downtime_reason_id', $downtime->downtimesReasonsList->pluck('name', 'id')->toArray(), null, ['class'=>'form-control', 'placeholder' => '--Select One']) !!}
        {!! $errors->first('downtime_reason_id', '<span class="text-danger">:message</span>') !!}
    </div>
</div>
<!-- /. Downtime Reason -->
<!-- Reported By -->
<div class="col-xs-12 col-sm-6 col-md-4">
    <div class="form-group {{ $errors->has('reported_by') ? 'has-error' : null }}">
        {!! Form::label('reported_by', ' Reported By:', ['class'=>'']) !!}
        {!! Form::select('reported_by', $downtime->activeSupervisorsList->pluck('name', 'name')->toArray(), null, ['class'=>'form-control', 'placeholder' => '--Select One']) !!}
        {!! $errors->first('reported_by', '<span class="text-danger">:message</span>') !!}
    </div>
</div>

                            