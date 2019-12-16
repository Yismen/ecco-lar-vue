<div class="row">
	<div class="col-xs-8">
		<!-- Name -->
			<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
			{!! Form::label('name', ' Name:', ['class'=>'col-sm-12']) !!}
			<div class="col-sm-12">
				{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Name']) !!}
				{!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
		<!-- /. Name -->
	</div>
	
	<div class="col-xs-4">
		<!-- Color -->
		<div class="form-group {{ $errors->has('color') ? 'has-error' : null }}">
			{!! Form::label('color', ' Color:', ['class'=>'col-sm-12']) !!}
			<div class="col-sm-12">
				{!! Form::input('color', 'color', null, ['class'=>'form-control', 'value' => '#FFFFFF', 'colorpick-eyedropper-active' => "false"]) !!}
				{!! $errors->first('color', '<span class="text-danger">:message</span>') !!}
			</div>
		</div>
		<!-- /. Color -->
	</div>
</div>