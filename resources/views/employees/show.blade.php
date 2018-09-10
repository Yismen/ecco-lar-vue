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
							@if ($employee->position)
								<h5>
									{{ $employee->position->name }}
									@if ($employee->position->department->count)
										, at {{ $employee->position->department->department }}	
									@endif
								</h5>
							@endif
							
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
							<li class="list-group-item {{ $employee->gender && $employee->gender->gender == 'Femenine' ? 'text-warning' : 'text-info' }}">
								<strong>Gender: </strong>
								@if ($employee->gender)
									<i class="fa fa-{{ $employee->gender && $employee->gender->gender == 'Femenine' ? 'female' : 'male' }}"></i> 
									{{ $employee->gender->gender ?? '' }}
								@endif
							</li>
							<li class="list-group-item">
								<strong>Has Kids?: </strong>{{ $employee->has_kids ? 'Yes' : 'No' }}
							</li>
							@if ($employee->marital->count > 0)
								<li class="list-group-item">
									<strong>Marital Status: </strong>{{ $employee->marital->name ?? '' }}
								</li>
							@endif
								
							<li class="list-group-item">
								<strong>Date of Birth: </strong>{{ Carbon\Carbon::parse($employee->date_of_birth)->format('M-d-Y') }}
									, {{ Carbon\Carbon::parse($employee->date_of_birth)->age }} Years
							</li>
						 
							<li class="list-group-item">
								<strong>Supervisor: </strong>
								{{ $employee->supervisor->name ?? '' }}									
							</li>	
						 
							<li class="list-group-item">
								<strong>Ars: </strong> {{ $employee->ars->name ?? '' }} <br>
								<strong>Afp: </strong> {{ $employee->afp->name ?? '' }}								
							</li>	
						 
							<li class="list-group-item">
								<strong>Position: </strong>
								{{ $employee->position->name ?? '' }}, At {{ $employee->position->department->department ?? '' }}					
							</li>	

							<li class="list-group-item">
								<strong>Salary: </strong>
								@if ($employee->position)
									${{ number_format($employee->position->salary, 2) }}, 
									{!! $employee->position->payment_type->name ?? '<span class="text-danger">Missing Payment Type in his position. Please fix!</span>' !!}, 
									{!! $employee->position->payment_frequency->name ?? '<span class="text-danger">Missing Payment Frequency in his position. Please fix!</span>' !!} 
									<a href="{{ route('admin.positions.edit', $employee->position->id) }}"><i class="fa fa-pencil"></i></a>
								@endif
							</li>
						
							<li class="list-group-item">
								<strong>Address: </strong>
								@if ($employee->addresses)
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