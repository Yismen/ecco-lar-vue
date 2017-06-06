<!-- Department Name -->
<div class="col-sm-12">
	<div class="form-group {{ $errors->has('department') ? 'has-error' : null }}">
		{!! Form::label('department', 'Department Name:', ['class'=>'col-sm-2 control-label']) !!}
		<div class="col-sm-10">
			<div class="input-group">
				{!! Form::input('text', 'department', null, ['class'=>'form-control', 'placeholder'=>'Department Name']) !!}     
				<span class="input-group-btn">
					{!! Form::input('submit', 'Save', 'Save!', ['class'=>'btn btn-primary']) !!}
				</span>   
			</div>
	        {!! $errors->first('department', '<span class="text-danger">:message</span>') !!}
		</div>
	</div>
</div>
<!-- /. Department Name -->