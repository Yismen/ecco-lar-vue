{{-- Display Errors --}}
@if( $errors->any() )
    <div class="col-sm-12">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
{{-- /. Errors --}}

<!-- Insert Date -->
<div class="form-group form-group-sm {{ $errors->has('insert_date') ? 'has-error' : null }}">
    {!! Form::label('insert_date', 'Insert Date:', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::input('date', 'insert_date', null, ['class'=>'form-control', 'placeholder'=>'Insert Date', 'disabled']) !!}
    </div>
</div>
<!-- /. Insert Date -->

<!-- Time In -->
<div class="form-group form-group-sm {{ $errors->has('in_time') ? 'has-error' : null }}">
    {!! Form::label('in_time', 'Time In:', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::input('datetime-local', 'in_time', null, ['class'=>'form-control', 'placeholder'=>'Time In']) !!}
    </div>
</div>
<!-- /. Time In -->

<!-- Production Hours -->
<div class="form-group form-group-sm {{ $errors->has('production_hours') ? 'has-error' : null }}">
    {!! Form::label('production_hours', 'Production Hours:', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::input('number', 'production_hours', null, ['class'=>'form-control', 'placeholder'=>'Production Hours']) !!}
    </div>
</div>
<!-- /. Production Hours -->

<!-- Break Time in Minutes -->
<div class="form-group form-group-sm {{ $errors->has('break_time') ? 'has-error' : null }}">
    {!! Form::label('break_time', 'Break Time in Minutes:', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::input('number', 'break_time', null, ['class'=>'form-control', 'placeholder'=>'Break Time in Minutes']) !!}
    </div>
</div>
<!-- /. Break Time in Minutes -->

<!-- Downtime in Hours -->
<div class="form-group form-group-sm {{ $errors->has('downtime') ? 'has-error' : null }}">
    {!! Form::label('downtime', 'Downtime in Hours:', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::input('number', 'downtime', null, ['class'=>'form-control', 'placeholder'=>'Downtime in Hours']) !!}
    </div>
</div>
<!-- /. Downtime in Hours -->

<!-- Reason for Downtime -->
<div class="form-group {{ $errors->has('reason_list') ? 'has-error' : null }}">
    {!! Form::label('reason_list', 'Reason for Downtime:', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('reason_list', $reasonsList, null, ['class'=>'form-control input-sm']) !!}
    </div>
</div>
<!-- /. Reason for Downtime -->

<!-- Out Time -->
<div class="form-group form-group-sm {{ $errors->has('out_time') ? 'has-error' : null }}">
    {!! Form::label('out_time', 'Out Time:', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::input('datetime-local', 'out_time', null, ['class'=>'form-control', 'placeholder'=>'Out Time', 'readonly']) !!}
    </div>
</div>
<!-- /. Out Time -->

<!-- Production -->
<div class="form-group form-group-sm {{ $errors->has('production') ? 'has-error' : null }}">
    {!! Form::label('production', 'Production:', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::input('number', 'production', null, ['class'=>'form-control', 'placeholder'=>'Production', 'disabled']) !!}
    </div>
</div>
<!-- /. Production -->

<!-- Client -->
<div class="form-group form-group-sm {{ $errors->has('client') ? 'has-error' : null }}">
    {!! Form::label('client_list', 'Client:', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('client_list', $clientList, null, ['class'=>'form-control input-sm', 'disabled']) !!}
    </div>
</div>
<!-- /. Client -->

<!-- Source -->
<div class="form-group form-group-sm  {{ $errors->has('source_list') ? 'has-error' : null }}">
    {!! Form::label('source_list', 'Source:', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('source_list', $sourceList, null, ['class'=>'form-control input-sm', 'disabled']) !!}
    </div>
</div>
<!-- /. Source -->