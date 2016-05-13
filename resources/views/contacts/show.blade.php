@extends('layouts.main')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
			<br>
				<div class="">
					<div class="table-responsive">
						<h4>Contact Details</h4>
						<table class="table table-hover">
							<thead>
								
							</thead>
							<tbody>
								<tr>
									<th>Name</th>
									<td>{{ $contact->name }}</td>
								</tr>
								<tr>
									<th>Main Phone Contact</th>
									<td>{{ $contact->main_phone }}</td>
								</tr>
								<tr>									
									<th>Email Address</th>
									<td>{!! HTML::mailto($contact->email, $contact->email) !!}</td>
								</tr>
								<tr>
									<th>Works At</th>
									<td>{{ $contact->works_at }}</td>
								</tr>
								<tr>
									<th>Works As</th>
									<td>{{ $contact->position }}</td>
								</tr>
								<tr>
									<th>Secondary Phone</th>
									<td>{{ $contact->secondary_phone }}</td>
								</tr>
								<tr>
									<th>Visibility</th>
									<td>{{ $contact->public ? 'Public' : 'Private' }}</td>
								</tr>
								<tr>
									<th>Create by</th>
									<td>{{ $contact->user->name }}</td>
								</tr>
								<tr>
									<td>
										{!! HTML::linkRoute("contacts.index", "Return to Contacts") !!}
									</td>									
									<td>
										@if ($contact->username == Auth::user()->username)
											{!! HTML::linkRoute("contacts.edit", "Edit", $contact->id, ['class'=>'btn btn-warning']) !!}
										@endif
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
	
@stop