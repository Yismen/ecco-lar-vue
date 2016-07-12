@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Employees', 'page_description'=>'List of active employees.'])

@section('content')
	<div class="container">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary pad">
				<div class="row">

					<div class="col-sm-12">


						<div class="employees">		
							<div class="table-responsive">
								<table class="table table-hover table-condensed" id="employees-table">
									<thead>
										<tr>
											<th>Employee ID:</th>
											<th>First Name:</th>
											<th>Last Name:</th>
											<th>Position:</th>
											<th>Personal ID:</th>
											<th>Cell Phone:</th>
											
										</tr>
									</thead>
									
								</table>
							</div>	

						</div>
						
					</div><!-- /. Primary box -->
				</div>
			</div>
		</div>
	</div>
@endsection



@section('scripts')
	<script>
		(function($){
			$('#employees-table').dataTable({
				"processing": true,
		       	"serverSide": true,
		        "ajax": "/admin/datatables/employees",
		        "rowId": 'id',
		        "columns": [
		        	{data: 'id', name: 'id'},
		        	{data: 'first_name', name: 'first_name'},
		        	{data: 'last_name', name: 'last_name'},
		        	{data: 'position_id', name: 'position_id'},
		        	{data: 'personal_id', name: 'personal_id'},
		        	{data: 'cellphone_number', name: 'cellphone_number'}
		        ]
			});
			
		})(jQuery);

	</script>
	
@stop