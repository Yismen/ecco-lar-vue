@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Employees', 'page_description'=>'List of active employees.'])

@section('content')
	<div class="container">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="box box-primary pad">
				<div class="row ">

					<div class="col-sm-12">

						<div id="advanced-search"><a href="#">Toggle Advanced Search Form:</a></div>

						<div id="advanced-search-form-div">
							<form>

								<div class="col-xs-5 form-group {{ $errors->has('where') ? 'has-error' : null }}">
									{!! Form::label('where', 'Where:', ['class'=>'']) !!}
									{!! Form::select('where', [], null, ['class'=>'form-control input-sm']) !!}
								</div>
								<!-- /. Where -->

								<div class="col-xs-2 form-group {{ $errors->has('operator') ? 'has-error' : null }}">
									{!! Form::label('operator', 'Is:', ['class'=>'']) !!}
									{!! Form::select('operator', [], null, ['class'=>'form-control input-sm']) !!}
								</div>
								<!-- /. Is -->

								<div class="col-xs-5 form-group {{ $errors->has('value') ? 'has-error' : null }}">
									{!! Form::label('value', 'Value:', ['class'=>'']) !!}
									{!! Form::select('value', [], null, ['class'=>'form-control input-sm']) !!}
								</div>
								<!-- /. Value -->
							</form>
						</div>


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
			$(document).ready(function($) {

				$('#employees-table').DataTable({
					"processing": true,
			       	"serverSide": true,
			        "ajax": "{{ route('admin.employees.index') }}",
			        "columns": [
			        	{data: 'id', name: 'id'},
			        	{data: 'first_name', name: 'first_name'},
			        	{data: 'last_name', name: 'last_name'},
			        	{data: 'position_id', name: 'position_id'},
			        	{data: 'personal_id', name: 'personal_id'},
			        	{data: 'cellphone_number', name: 'cellphone_number'}
			        ]
				});

				/**
				 * Toggle visibility for advance search form when the link is clicked
				 */
				$(document).on('click', '#advanced-search', function(e){
					e.preventDefault();

					$('#advanced-search-form-div').toggle();
				});
				
			});

				
		})(jQuery);

	</script>
	
@stop