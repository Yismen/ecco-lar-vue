<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
	<label for="name" class="col-sm-2">Client Name:</label>
	<div class="col-sm-10">
		{!! Form::text('name', null, ['class'=>'form-control', 'id'=>'name', 'placeholder'=>'Client Name']) !!}
		{!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
{{-- /.Client Name --}}

<div class="row">
	<div class="col-sm-6">
		<h4>Departments</h4>
		{!! $errors->first('departments', '<span class="text-danger">:message</span></br>') !!}
		<span class="help-text">Select the Departments associated to this Client</span>
		<p>
			@foreach ($client->departments_list as $department)

				<div class="checkbox">
					<label>
						{!! Form::checkbox('departments[]', $department->id, null, []) !!}
						{{ $department->name }}
					</label>
				</div>

			@endforeach
		</p>
	</div>
	{{--  /. Departments  --}}
	<div class="col-sm-6">
		<h4>Sources</h4>
		{!! $errors->first('sources', '<span class="text-danger">:message</span></br>') !!}
		<span class="help-text">Select the Sources associated to this Client</span>
		<p>
			@foreach ($client->sources_list as $source)

				<div class="checkbox">
					<label>
						{!! Form::checkbox('sources[]', $source->id, null, []) !!}
						{{ $source->name }}
					</label>
				</div>

			@endforeach
		</p>
	</div>
</div>





