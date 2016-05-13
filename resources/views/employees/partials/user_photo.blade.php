
<div class="col-sm-12">
	<div class="col-sm-6">
		<img src="{{ file_exists($employee->photo) ? asset($employee->photo) : 'http://placehold.it/200x200' }}" class="img-circle img-responsive img-center profile-image animated" alt="Image" id="show-photo">
	</div>
	<div class="col-sm-6">
		{!! Form::open(['route' => ['admin.employees.updatePhoto', $employee->id], 'method' => 'POST', 'files' => true, 'id'=>'photo_form']) !!}
			<div class="form-group">
				<legend>Edit {{ $employee->first_name }}'s Photo</legend>
			</div>
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
			<div class="errors-area"></div>
			{{-- /. Errors --}}
			<div class="form-group {{ $errors->has('photo') ? 'has-error' : null }}" id="photo_form_group">
				{!! Form::label('photo', 'Photo:', ['class'=>'']) !!}
				{!! Form::input('file', 'photo', null, ['class'=>'form-control input-sm', 'placeholder'=>'Photo']) !!}
			</div>
			{!! Form::button('Update Photo', ['type'=> 'submit', 'class'=>'btn btn-primary save-photo']) !!}
		{!! Form::close() !!}
		<hr>
		<a href="{{ route('admin.employees.show', $employee->id) }}">Cancel and return <i class="fa fa-angle-double-left"></i></a>
			
	</div>
</div>

