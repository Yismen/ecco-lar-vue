@extends('layouts.main')

@section('content')
	<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 wesll">	
		<div class="table-responsive">
			<?php $icon = '<i class="fa fa-plus"></i>' ?>
			<h1>{{ Auth::user()->name}}'s Contacts <small>( {!! link_to_route("contacts.create", "", null, ['class'=>'fa fa-plus']) !!} )</small></h1>
			<hr>
			<table class="table table-hover table-condensed">
				<thead>
					<tr>
						<th>Name</th>
						<th>Main Phone</th>
						<th>Email Address</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($contacts as $contact)
						<tr>
							<td>{{ $contact->name}}</td>
							<td>{{ $contact->main_phone}}</td>
							<td>{!! HTML::mailto($contact->email, $contact->email) !!}</td>
							<td>
								{!! HTML::linkRoute("contacts.show", "Details", $contact->id, ['class'=>'btn btn-default']) !!}
								@if ( $contact->username == Auth::user()->username )
									{!! HTML::linkRoute("contacts.edit", "Edit", $contact->id, ['class'=>'btn btn-warning']) !!}
								@endif
							</td>
						</tr>
					@endforeach	
				</tbody>
				<tfoot>	
					<tr>
						<td colspan="10">{!! $contacts->render() !!}</td>
					</tr>
				</tfoot>
			</table>
		</div>	
	</div>
@stop

			