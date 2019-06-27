<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
	<label for="name" class="col-sm-2">Downtime Reason:</label>
	<div class="col-sm-10">
		{!! Form::text('name', null, ['class'=>'form-control', 'id'=>'name', 'placeholder'=>'Downtime Reason']) !!}
		{!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
{{-- /.Downtime Reason --}}

