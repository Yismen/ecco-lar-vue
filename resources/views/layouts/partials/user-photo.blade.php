{{-- Use variable $class_image_class to pass additional classes --}}

@if ($user->profile && file_exists($user->profile->photo))
	<img src="{{ asset($user->profile->photo) }}" class="img-circle {{ $class_image_class ?? '' }}" alt="User Image">
@else
	<img src="https://placehold.it/150x150" class="img-circle {{ $class_image_class ?? '' }}" alt="User Image">
@endif
