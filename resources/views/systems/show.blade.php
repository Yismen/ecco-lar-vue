@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	@if ($system)
		<div class="col-sm-4 col-sm-offset-4 well row">
			<ul class="list-group">
				<li class="list-group-item">
					<strong>Name: </strong>{{ $system->name }}
				</li>
				<li class="list-group-item">
					<strong>Display Name: </strong>{{ $system->display_name }}
				</li>
				<li class="list-group-item">
					<strong>Description: </strong>{{ $system->description }}
				</li>
				
				<li class="list-group-item">
					<strong>URL: </strong>{{ $system->url }}
				</li>
			</ul>
			<a href="{{ route('systems.edit', $system->id) }}" class="btn btn-warning"> Edit </a>
			{{-- {!! delete_button('systems.destroy', $system->id, ['class'=>"btn btn-danger", 'label' => 'Delete']) !!} --}}
			<hr>
			<a href="{{ route('systems.index') }}" class=""> << Return to Systems List</a>
		</div>
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@section('scripts')
	
@stop