
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

<!-- System Name -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
	{!! Form::label('name', 'System Name:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'System Name']) !!}
	</div>
	{{-- {!! $errors->first('name', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. System Name -->

<!-- Display Name -->
<div class="form-group {{ $errors->has('display_name') ? 'has-error' : null }}">
	{!! Form::label('display_name', 'Display Name:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'display_name', null, ['class'=>'form-control', 'placeholder'=>'Display Name']) !!}
	</div>
	{{-- {!! $errors->first('display_name', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Display Name -->

<!-- Description -->
<div class="form-group {{ $errors->has('description') ? 'has-error' : null }}">
	{!! Form::label('description', 'Description:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('text', 'description', null, ['class'=>'form-control', 'placeholder'=>'Description']) !!}
	</div>
	{{-- {!! $errors->first('description', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. Description -->

<!-- URL -->
<div class="form-group {{ $errors->has('url') ? 'has-error' : null }}">
	{!! Form::label('url', 'URL:', ['class'=>'col-sm-2 control-label']) !!}
	<div class="col-sm-10">
		{!! Form::input('url', 'url', null, ['class'=>'form-control', 'placeholder'=>'URL']) !!}
	</div>
	{{-- {!! $errors->first('url', '<span class="text-danger">:message</span>') !!} --}}
</div>
<!-- /. URL -->

<link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
<script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
<script>
	jQuery(document).ready(function($) {
		$('#users_lists, #permissions_lists, #menus_lists').select2();
	});
</script>


