<div class="form-group {{ $errors->has('tracking') ? 'has-error' : null }}">
	{!! Form::label('tracking', 'Tracking #:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'tracking', null, ['class'=>'form-control', 'placeholder'=>'Tracking #']) !!}        
        {!! $errors->first('tracking', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
<!-- /. Tracking # -->

<!-- Client -->
<div class="form-group {{ $errors->has('escalations_client_id') ? 'has-error' : null }}">
    {!! Form::label('escalations_client_id', 'Client:', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('escalations_client_id', $escalations_record->escalationsClients, null, ['class'=>'form-control']) !!}
        {!! $errors->first('escalations_client_id', '<span class="text-danger">:message</span>') !!}
    </div>
</div>
<!-- /. Client -->
<div class="form-group">
    <div class="col-sm-9 col-sm-offset-2 bg-warning">
        
        <div class="checkbox">
            <label class=" text-warning" style="display: block">
                {!! Form::checkbox('is_additional_line', '1', null, ['id' => 'is_additional_line']) !!} 
                Additional Line
            </label>
        </div>
        
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-9 bg-danger">
        <div class="checkbox warning">
            <label for="is_bbb" style="display: block">
                {!! Form::checkbox('is_bbb', '1', null, ['id' => 'is_bbb']) !!} Is BBB or Attorney General?
                <span class="help-block">Check this box if the CS Agent provides any of the following in their comments: BBB / Better Business Bureau / Attorney General / Threatening a law suit or small claims court / Threatening to cancel service / Asking for VZW corporate contacts</span>
            </label>
        </div>
    </div>
</div>  
