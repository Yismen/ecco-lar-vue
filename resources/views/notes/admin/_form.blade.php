@include('layouts.partials.errors-div')

<div class="form-group {{ $errors->has('title') ? 'has-error' : null }}">
	{!! Form::label('title', 'Note Name:', ['class'=>'']) !!}
	<div class="input-group">
		<div class="input-group-addon"><i class="fa fa-font"></i></div>
		{!! Form::input('text', 'title', null, ['class'=>'form-control', 'placeholder'=>'Note Name']) !!}
	</div>
</div>
<!-- /. Note Name -->

<div class="form-group {{ $errors->has('tags') ? 'has-error' : null }}">
	{!! Form::label('tags', 'Tags:', ['class'=>'']) !!}
	<div class="input-group">
		<div class="input-group-addon"><i class="fa fa-tag"></i></div>
		{!! Form::input('text', 'tags', null, ['class'=>'form-control', 'placeholder'=>'Tags']) !!}
	</div>
	<span class="help-block">Use commas to separate multiple tags!</span>
</div>
<!-- /. Tags -->


<div class="form-group {{ $errors->has('body') ? 'has-error' : null }}">
	{!! Form::label('body', 'Content:', ['class'=>'']) !!}
	{!! Form::textarea('body', null, ['class'=>'form-control', 'placeholder'=>'Content']) !!}
</div>
<!-- /. Content -->

@section('scripts')
	
@stop
