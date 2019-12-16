

<div class="box box-primary">
	<div class="box-header">		
		<h4>
			Create Attendance Codes
		</h4>
	</div>

	{!! Form::open(['route'=>['admin.attendance_codes.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form']) !!}		
		<div class="box-body">	
			@include('attendance_codes._form')
		</div>
		
		<div class="box-footer">
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary">Create</button>	
				</div>
			</div>
		</div>
	{!! Form::close() !!}
</div>