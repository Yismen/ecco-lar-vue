@if (auth()->user()->profile && file_exists(auth()->user()->profile->photo))       
	<img src="{{ asset(auth()->user()->profile->photo) }}" class="img-responsive img-circle center-block" alt="Image">
@else       
	<img src="http://placehold.it/800x600" class="img-responsive img-circle center-block" alt="Image">
@endif 