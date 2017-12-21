@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Positions', 'page_description'=>$position->name.'\'s details'])

@section('content')
	@if ($position)
		<div class="container-fluid">
			<div class="box box-primary pad">
				<div class="box-body">
					<ul class="list-group">
					<li class="list-group-item">
						<strong>Name: </strong>{{ $position->name }}
					</li>
					<li class="list-group-item">
						<strong>Department: </strong>{{ $position->department->department }}
					</li>
					<li class="list-group-item">
						<strong>Payment Type: </strong>{{ $position->payment_type ? $position->payment_type->name : 'Please Add One!' }}
					</li>
					<li class="list-group-item">
						<strong>Payment Frequency: </strong>{{ $position->payment_frequency ? $position->payment_frequency->name : 'Please Add One!' }}
					</li>
					<li class="list-group-item">
						<strong>Saraly: </strong>RD$ {{ $position->salary }}
					</li>
				</ul>
					<a href="{{ route('admin.positions.edit', $position->id) }}" class="btn btn-warning"> Edit </a>
					<a href="{{ route('admin.positions.index') }}" class="pull-right" title="Back to the list"><i class="fa fa-list"></i></a>
				</div>
			</div>
		</div>
		{{-- /. Row --}}
	@else
		{{-- false expr --}}
	@endif
@stop

@section('scripts')
	
@stop