<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
	<label for="name" class="col-sm-2">Client Name:</label>
	<div class="col-sm-10">
		{!! Form::text('name', null, ['class'=>'form-control', 'id'=>'name', 'placeholder'=>'Client Name']) !!}
		{!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
{{-- /.Client Name --}}

<div class="form-group {{ $errors->has('contact_name') ? 'has-error' : null }}">
	<label for="contact_name" class="col-sm-2">Person of Contact:</label>
	<div class="col-sm-10">
		{!! Form::text('contact_name', null, ['class'=>'form-control', 'id'=>'contact_name', 'placeholder'=>'Person of Contact']) !!}
		{!! $errors->first('contact_name', '<span class="text-danger">:message</span>') !!}
	</div>
</div>
{{-- /.Client Contact Name --}}
<div class="row">
	<div class="col-sm-6">
		<div class="col-sm-12">
			<div class="form-group {{ $errors->has('main_phone') ? 'has-error' : null }}">
				<label for="main_phone">Phone Number:</label>
				{!! Form::text('main_phone', null, ['class'=>'form-control', 'id'=>'main_phone', 'placeholder'=>'Phone Number']) !!}
				{!! $errors->first('main_phone', '<span class="text-danger">:message</span>') !!}
			</div>
			{{-- /.Phone Number --}}
			<div class="form-group {{ $errors->has('email') ? 'has-error' : null }}">
				<label for="email">Email:</label>
				{!! Form::email('email', null, ['class'=>'form-control', 'id'=>'email', 'placeholder'=>'Email']) !!}
				{!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
			</div>
			{{-- /.Email --}}
		</div>
	</div>
	<div class="col-sm-6">
		<div class="col-sm-12">
			<div class="form-group {{ $errors->has('secondary_phone') ? 'has-error' : null }}">
				<label for="secondary_phone">Secondary Phone Number:</label>
				{!! Form::text('secondary_phone', null, ['class'=>'form-control', 'id'=>'secondary_phone', 'placeholder'=>'Secondary Phone Number']) !!}
				{!! $errors->first('secondary_phone', '<span class="text-danger">:message</span>') !!}
			</div>

			{{-- /.Secondary Phone Number --}}
			<div class="form-group {{ $errors->has('account_number') ? 'has-error' : null }}">
				<label for="account_number">Account Number:</label>
				{!! Form::text('account_number', null, ['class'=>'form-control', 'id'=>'account_number', 'placeholder'=>'Account Number']) !!}
				{!! $errors->first('account_number', '<span class="text-danger">:message</span>') !!}
			</div>
			{{-- /.Account Number --}}
		</div>
	</div>
</div>

