@extends('layouts.main')

@section('content')
	<div class="container">
		{!! Form::open(['route'=>['postTest'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off", 'id'=>'test']) !!}		
			<div class="form-group">
				<legend>Form title</legend>
			</div>
		
			<div class="form-group">
				<label for="">label</label>
				<input type="text" class="form-control" id="" placeholder="Input field">
			</div>
		
			
		
			<button type="submit" class="btn btn-primary">Submit</button>
		
		{!! Form::close() !!}	
			
		<script src="{{ asset('js/scripts/ajax-requests.js') }}"></script>
		<script>
			$('#test').ajaxRequest();

		</script>	
	</div>
@stop