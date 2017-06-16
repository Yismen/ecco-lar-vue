@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Employees', 'page_description'=>'Show Details'])

@section('content')
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary pad">
				<div class="box-body">
					<div class="col-sm-6 text-centered">
						<img src="{{ file_exists(trim(explode('?', $employee->photo)[0], '/')) ? asset($employee->photo) : 'http://placehold.it/200x200' }}" 
							class="img-circle img-responsive center-block profile-image animated fadeIn" alt="Image" width="200px">

						<div class="text-center animated zoomIn">
							<h3>{{ $employee->full_name }}</h3>
							@unless ($employee->position->isEmpty)
								<h5>
									{{ $employee->position->name }}
									@if (count($employee->position->department) > 0)
										, at {{ $employee->position->department->department }}	
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
					<div class="col-sm-6 animated bounceIn">
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
							<li class="list-group-item {{ $employee->gender->gender == 'Femenine' ? 'text-warning' : 'text-info' }}">
								<strong>Gender: </strong>
								<i class="fa fa-{{ $employee->gender->gender == 'Femenine' ? 'female' : 'male' }}"></i> 
								{{ $employee->gender->gender }}
							</li>
							<li class="list-group-item">
								<strong>Has Kids?: </strong>{{ $employee->has_kids ? 'Yes' : 'No' }}
							</li>
							@if (count($employee->marital) > 0)
								<li class="list-group-item">
									<strong>Marital Status: </strong>{{ $employee->marital->name }}
								</li>
							@endif
								
							<li class="list-group-item">
								<strong>Date of Birth: </strong>{{ Carbon\Carbon::parse($employee->date_of_birth)->format('M-d-Y') }}
									, {{ Carbon\Carbon::parse($employee->date_of_birth)->age }} Years
							</li>
						 
							<li class="list-group-item">
								<strong>Supervisor: </strong>
								@if (count($employee->supervisor) > 0)
									{{ $employee->supervisor->name }}
								@endif									
							</li>	
						 
							<li class="list-group-item">
								<strong>Position: </strong>
								@if (count($employee->position) > 0)
									{{ $employee->position->name }}, At {{ $employee->position->department->department }}
								@endif									
							</li>	

							<li class="list-group-item">
								<strong>Salary: </strong>
								@if (count($employee->position) > 0)
									${{ number_format($employee->position->salary, 2) }}, {{ $employee->position->payment->payment_type }}
								@endif
							</li>
						
							<li class="list-group-item">
								<strong>Address: </strong>
								@if (count($employee->addresses) > 0)
									{{ $employee->addresses->street_address }}, {{ $employee->addresses->sector }}. {{ $employee->addresses->city }}
								@endif
							</li>

							<li class="list-group-item">
								<strong>Logins: </strong>
								@if (count($employee->logins) > 0)
									<ul>
										@foreach ($employee->logins as $login)
											<li>{{ $login->login }}</li>
										@endforeach
									</ul>
								@endif
									
							</li>
						</ul>
					</div>
				</div>
				{{-- /. Details --}}
			</div>
		</div>
	</div>
@endsection