
	{!! Form::open(['route'=>['tasks.store'], 'class'=>'', 'role'=>'form']) !!}		
		<div class="form-group">
			<legend>
				Your Tasks ( <span class="text-danger">{!! HTML::linkRoute("ajaxRemoveCompleted", "Remove Completed", null, ['id'=>'removeAll', 'data-toggle'=>"confirmation"]) !!}</span> )
			</legend>
		</div>
	
		<div class="form-group {{ $errors->has('task_name') ? 'has-error' : null }}">
			{!! Form::label('task_name', 'Enter Task Name:', ['class'=>'']) !!}
			<div class="input-group">
				{!! Form::input('text', 'task_name', null, ['class'=>'form-control', 'placeholder'=>'Enter Task Name']) !!}
				<span class="input-group-btn">
		        	{!! Form::button('Save!', ['type'=>'submit', 'class'=>'btn btn-default']) !!}
		      </span>
			</div>
			{!! $errors->first('task_name', '<small class="help-block">:message</small>') !!}
		</div>
	
	{!! Form::close() !!}