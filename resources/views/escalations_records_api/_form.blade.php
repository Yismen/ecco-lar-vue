{{-- Display Errors --}}
{{-- @if( $errors->any() )
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
@endif --}}
{{-- /. Errors --}}
<!-- Tracking # -->
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

