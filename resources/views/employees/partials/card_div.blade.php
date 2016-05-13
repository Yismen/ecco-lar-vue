
<div class="col-sm-12">
	{!! Form::model($employee->card, ['route'=>['admin.employees.updateCard', $employee->id], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off", 'id' => 'card_form']) !!}		
		<div class="form-group">
			<legend>Edit {{ $employee->first_name }} {{ $employee->last_name }} Card ID</legend>
		</div>
		
		<div class="ajax-messages"></div>
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

		<!-- Card ID -->
		<div class="form-group {{ $errors->has('card') ? 'has-error' : null }}">
			{!! Form::label('card', 'Card ID:', ['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-10">
				{!! Form::input('text', 'card', null, ['class'=>'form-control', 'placeholder'=>'Card ID']) !!}
			</div>
		</div>
		<!-- /. Card ID -->


		<!-- Save Card Form Submit -->
		<div class="form-group">
			{!! Form::button('Save ACard ID', ['type'=> 'submit', 'class'=>'btn btn-primary col-xs-4 pull-right', 'id'=>'save_card']) !!}
		</div>

	{!! Form::close() !!}
</div>
