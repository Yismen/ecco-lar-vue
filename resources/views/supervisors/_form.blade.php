<!-- Name -->
<div class="col-sm-12">
	<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
		{!! Form::label('name', 'Name:', ['class'=>'col-sm-2 control-label']) !!}
		<div class="col-sm-10">
			{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Name']) !!}        
	        {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
</div>
<!-- /. Name -->

<!-- Project -->
<div class="col-sm-12">
	<div class="form-group {{ $errors->has('department_id') ? 'has-error' : null }}">
		{!! Form::label('department_id', 'Project:', ['class'=>'col-sm-2 control-label']) !!}
		<div class="col-sm-10">
			{!! Form::select('department_id', $supervisor->departmentsList, null, ['class'=>'form-control input-sm']) !!}
	        {!! $errors->first('department_id', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
</div>
<!-- /. Project -->