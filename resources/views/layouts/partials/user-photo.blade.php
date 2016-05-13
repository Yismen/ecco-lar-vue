@if ($user->profile && file_exists($user->profile->photo))
	<img src="{{ asset($user->profile->photo) }}" class="img-circle" alt="User Image">
@else
	<img src="https://placehold.it/150x150" class="img-circle" alt="User Image">
@endif