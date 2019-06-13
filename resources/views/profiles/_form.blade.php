@include('layouts.partials.errors-div')

<div class="col-sm-12">

	<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
		{!! Form::label('name', 'Your Name:', ['class'=>'']) !!}
		<div class="input-group">
			<div class="input-group-addon"><i class="fa fa-user"></i></div>
			{!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Your Name']) !!}
		</div>
	</div>
	<!-- /. Your Name -->
</div>
<div class="col-sm-6">

	<div class="form-group {{ $errors->has('gender') ? 'has-error' : null }}">
		{!! Form::label('gender', 'Your Gender:', ['class'=>'']) !!}
		<div class="input-group">
			<label class="radio-inline">
				{!! Form::radio('gender', 'male', null, ['options']) !!}Male <i class="fa fa-male"></i>
			</label>
			<label class="radio-inline">
				{!! Form::radio('gender', 'female', null, ['options']) !!}Female <i class="fa fa-female"></i>
			</label>
		</div>
	</div>
	<!-- /. Gender -->
</div>
<div class="col-sm-6">

	<div class="form-group {{ $errors->has('phone') ? 'has-error' : null }}">
		{!! Form::label('phone', 'Phone Number:', ['class'=>'']) !!}
		<div class="input-group">
			<div class="input-group-addon"><i class="fa fa-phone"></i></div>
			{!! Form::input('text', 'phone', null, ['class'=>'form-control', 'placeholder'=>'Phone Number']) !!}
		</div>
	</div>
	<!-- /. Phone Number -->

</div>

<div class="row">
	<div class="col-sm-12">
		<div class="form-group {{ $errors->has('bio') ? 'has-error' : null }}">
			{!! Form::label('bio', 'Your Bio:', ['class'=>'']) !!}
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-info"></i></div>
				{!! Form::textarea('bio', null, ['class'=>'form-control', 'placeholder'=>'Your Bio', 'rows'=>10]) !!}
			</div>
			<span class="help-block">Be very descriptive, rovide as much details as you can!</span>
		</div>
	</div>

</div>
<!-- /. Your Bio -->

<div class="row">
	<div class="col-md-6">
		<div class="form-group {{ $errors->has('education') ? 'has-error' : null }}">
			{!! Form::label('education', 'Educational Info:', ['class'=>'']) !!}
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-graduation-cap"></i></div>
				{!! Form::textarea('education', null, ['class'=>'form-control', 'placeholder'=>'Educational Info', 'rows'=>5]) !!}
			</div>
			<span class="help-block">Keep it short. Highlight your degrees!</span>
		</div>
		<!-- /. Education -->
	</div>

	<div class="col-md-6">
		<div class="form-group {{ $errors->has('skills') ? 'has-error' : null }}">
			{!! Form::label('skills', 'Skills:', ['class'=>'']) !!}
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-bolt"></i></div>
				{!! Form::input('text', 'skills', null, ['class'=>'form-control', 'placeholder'=>'Skills']) !!}
			</div>
			<span class="help-block">Separate skills by comma.</span>
		</div>
		<!-- /. Skills -->
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group {{ $errors->has('work') ? 'has-error' : null }}">
			{!! Form::label('work', 'Work Info:', ['class'=>'']) !!}
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-building"></i></div>
				{!! Form::textarea('work', null, ['class'=>'form-control', 'placeholder'=>'Work Info', 'rows'=>5]) !!}
			</div>
			<span class="help-block">Keep it short. Name of your company and your position there.</span>
		</div>
		<!-- /. Work Info -->
	</div>

	<div class="col-md-6">
		<div class="form-group {{ $errors->has('location') ? 'has-error' : null }}">
			{!! Form::label('location', 'Location Info:', ['class'=>'']) !!}
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
				{!! Form::textarea('location', null, ['class'=>'form-control', 'placeholder'=>'Location Info', 'rows'=>5]) !!}
			</div>
			<span class="help-block">Keep it short. Perhaps company's address or office location!</span>
		</div>
		<!-- /. Location Info -->
	</div>
</div>

<div class="row">
    <div class="col-md-6">
        @if (auth()->user()->profile && file_exists(auth()->user()->profile->photo))
            <a href="{{ asset(auth()->user()->profile->photo) }}" target="_user_photo">
            	<img src="{{ asset(auth()->user()->profile->photo) }}"
	            	class="img-responsive img-circle center-block" alt="Image"
	            	style="max-height: 150px; max-width: 125px;">
            </a>
        @else
            <img src="http://placehold.it/800x600"
            	class="img-responsive img-circle center-block" alt="Image"
            	style="max-height: 150px; max-width: 125px;">
        @endif
    </div>
    {{-- /.col --}}
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('photo') ? 'has-error' : null }}">
            {!! Form::label('photo', 'Your Photo:', ['class'=>'']) !!}
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                {!! Form::file('photo', ['class'=>'form-control', 'placeholder'=>'Your Photo']) !!}
            </div>
            <span class="help-block">If you choose a file your photo will be updated, otherwise current will stay!</span>
        </div>
        {{-- /.form-group --}}
    </div>
    {{-- /.col --}}
</div>







