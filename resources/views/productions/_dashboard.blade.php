<div class="list-group">
	<a href="#" class="list-group-item active">Productions Dashboard</a>
	<a href="#" class="list-group-item">Downtime Hours</a>
	<a href="{{ route('admin.production-hours.index') }}" class="list-group-item">Production Hours</a>
</div>
<?php 
	$field_options = [
		''=>'--Please Select--',
		'employee'=>'Employe\'s Name',
		'supervisor'=>'Supervisor',
	];

	$date_options = [
		''=>'--Please Select--',
		'today'=>'Today',
		'yesterday'=>'Yesterday',
		'this_week'=>'This Week',
		'last_week'=>'Last Week',
		'this_month'=>'This Month',
		'last_month'=>'Last Month',
		'this_year'=>'This Year',
		'last_year'=>'Last Year',
	];
 ?>

<div class="box-primary box pad">
	{!! Form::open(['route'=>['admin.productions.create'], 'method'=>'GET', 'class'=>'', 'role'=>'form', 'autocomplete'=>"off"]) !!}		
		<div class="form-group">
			<legend>Quick Filters</legend>
		</div>
	
		<div class="form-group {{ $errors->has('date_filter') ? 'has-error' : null }}">
			{!! Form::label('date_filter', 'Quick Date Filter:', ['class'=>'']) !!}
			{!! Form::select('date_filter', $date_options, null, ['class'=>'form-control input-sm']) !!}
		</div>
		<!-- /. Quick Date Filter -->

		<div class="form-group">
			{!! Form::button('Filter', ['class'=>'btn btn-primary', 'type'=>'submit']) !!}
		</div>
		<!-- /. Text -->
	
	{!! Form::close() !!}
</div>