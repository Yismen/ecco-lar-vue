<div>

	{!! Form::open(['route'=>['test'], 'method'=>'POST', 'class'=>'form-horizontal', 'files'=>true, 'role'=>'form', 'autocomplete'=>"off"]) !!}		
		<div class="form-group">
			<legend>Form title</legend>
		</div>
		{!! Form::file('name', []) !!}

		<button type="submit">Send</button>
	
	{!! Form::close() !!}


</div>