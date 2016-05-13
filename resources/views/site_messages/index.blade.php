@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'title', 'page_description'=>'description'])

@section('content')
	<div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
		<div class="well row ">
				<h3 class="page-header">
					Site Messages Items List{{-- 
					 (
						 <small>
						 	<a href="{{ route('site_messages.create') }}">
						 		<i class="fa fa-plus"></i>
						 	</a>
						 </small>
					 ) --}}
				</h3>
			@if ($site_messages->isEmpty())
				<div class="bs-callout bs-callout-warning">
					<h1>No Site Messages has been added yet, please add one</h1>
				</div>
			@else
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th>Person Name</th>
							<th>Message</th>
							<th class="col-xs-3">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($site_messages as $site_message)
							<tr>
								<td>
									<a href="{{ route('site_messages.show', $site_message->id) }}">{{ $site_message->customer_name }}</a>
								</td>
								<td>
									{{ mb_substr($site_message->message, 0, 120) }} ...
								</td>
								<td>
									<a href="{{ route('site_messages.edit', $site_message->id) }}" class="btn btn-warning" rel="tooltip" title="Edit" data-placement="left">
										<i class="fa fa-edit"></i>
									</a>
									{!! delete_button('site_messages.destroy', $site_message->id, ['class'=>'btn btn-danger','label'=>'<i class="fa fa-trash"></i>']) !!}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				{!! $site_messages->render() !!}
			@endif
		</div>
	</div>
@stop

@section('scripts')
	
@stop