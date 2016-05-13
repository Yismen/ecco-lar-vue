@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
{{ $site_message }}
	@if ($site_message)
		<div class="col-sm-4 col-sm-offset-4 well row">
			<ul class="list-group">
				<li class="list-group-item">
					<strong>Client: </strong>{{ $site_message->customer_name }}
				</li>
				<li class="list-group-item">
					<strong>Phone Number: </strong>{{ $site_message->phone }}
				</li>
				<li class="list-group-item">
					<strong>Email: </strong>{{ $site_message->email }}
				</li>
				<li class="list-group-item">
					<strong>About: </strong>{{ $site_message->contacttypes->contact_type }}
				</li>
				<li class="list-group-item">
					<strong>Message: </strong>{{ $site_message->message }}
				</li>
				<li class="list-group-item">
					<strong>Aswer: </strong>{{ $site_message->answer }}
				</li>
			</ul>
			<a href="{{ route('site_messages.edit', $site_message->id) }}" class="btn btn-warning"> Edit </a>
			{!! delete_button('site_messages.destroy', $site_message->id, ['class'=>"btn btn-danger", 'label' => 'Delete']) !!}
			<hr>
			<a href="{{ route('site_messages.index') }}" class=""> << Return to Site Messages List </a>
		</div>
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@section('scripts')
	
@stop