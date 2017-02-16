@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Employees', 'page_description'=>'Show Details'])

@section('content')
	<div class="container">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">

					<div class="row">
						<div class="col-sm-6 text-centered">
							{{-- {{ $employee->positions }} <br>
							@if (count($employee->positions->departments) > 0)
								, {{ $employee->positions->departments->department }}	
							@endif
							{{ die() }} --}}
							<img src="{{ file_exists($employee->photo) ? asset($employee->photo) : 'http://placehold.it/200x200' }}" class="img-circle img-responsive img-center profile-image animated" alt="Image" width="200px">

							<div class="text-center animated zoomIn">
								<h3>{{ $employee->full_name }}</h3>
								@unless ($employee->positions->isEmpty)
									<h5>
										{{ $employee->positions->name }}
										@if (count($employee->positions->departments) > 0)
											, {{ $employee->positions->departments->department }}	
										@endif
									</h5>
								@endunless
								
								<a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-warning">Edit <i class="fa fa-pencil"></i></a>

								<hr>
								<a href="{{ route('admin.employees.index') }}" title="Return to the employees' list.">Back to the list <i class="fa fa-list"></i></a>

							</div>
							{{-- /. Text center div --}}
						</div>
						{{-- /. Photo	 --}}
						<div class="col-sm-6">
							<ul class="list-group">
								<li class="list-group-item">
									<strong>Hired On: </strong>
										{{ Carbon\Carbon::parse($employee->hire_date)->format('M-d-Y') }}, 
										{{ Carbon\Carbon::parse($employee->hire_date)->diffForHumans() }}
								</li>
								<li class="list-group-item">
									<strong>Personal Id: </strong>{{ $employee->personal_id }}{{ $employee->passport }}
								</li>
								<li class="list-group-item">
									<strong>CellPhone Number: </strong>{{ $employee->cellphone_number }}
								</li>
								<li class="list-group-item">
									<strong>HousePhone Number: </strong>{{ $employee->secondary_number }}
								</li>
								<li class="list-group-item {{ $employee->genders->gender == 'Femenine' ? 'text-warning' : 'text-info' }}">
									<strong>Gender: </strong>{{ $employee->genders->gender }}
								</li>
								<li class="list-group-item">
									<strong>Has Kids?: </strong>{{ $employee->has_kids ? 'Yes' : 'No' }}
								</li>
								@if (count($employee->maritals) > 0)
									<li class="list-group-item">
										<strong>Marital Status: </strong>{{ $employee->maritals->name }}
									</li>
								@endif
									
								<li class="list-group-item">
									<strong>Date of Birth: </strong>{{ Carbon\Carbon::parse($employee->date_of_birth)->format('M-d-Y') }}
								</li>

								<li class="list-group-item">
									<strong>Salary: </strong>
									@if (count($employee->positions) > 0)
										{{ $employee->positions->salary }}
									@else
										<h4>No salary set for this employee</h4>
									@endif
								</li>

								<li class="list-group-item">
									<strong>Payment Type: </strong>
									@if (count($employee->positions) > 0)
										{{ $employee->positions->payments->payment_type }}
									@else
										<h4>No Payment type set for this employee</h4>
									@endif
									
								</li>		
								<li class="list-group-item">
									<strong>Address: </strong>
								{{-- 	@if (count($employee->addresses) > 0)
										<ul>
											<li>
												<u>Street Address</u>: {{ $employee->addresses->street_address }}
											</li>

											<li>
												<u>Zone or Sector</u>: {{ $employee->addresses->sector }}
											</li>									<li>
												<u>City</u>: {{ $employee->addresses->city }}
											</li>
										</ul>
									@else
										<h4>No Address Saved yet</h4>
									@endif --}}
								</li>

								<li class="list-group-item">
									<strong>Logins: </strong>
									@if (count($employee->logins) > 0)
										<ul>
											@foreach ($employee->logins as $login)
												<li>{{ $login->login }}</li>
											@endforeach
										</ul>
									@else
										<h4>No Logins saved for this user so far..</h4>
									@endif
										
								</li>
										{{-- expr --}}
							</ul>
						</div>
						{{-- /. Details --}}
					</div>

					
				</div>
			</div>
		
	</div>
@endsection