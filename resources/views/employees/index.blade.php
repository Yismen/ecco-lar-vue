@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Employees', 'page_description'=>'List of active employees.'])

@section('content')
	<div class="col-sm-10 col-sm-offset-1">
		<div class="box box-primary pad">
				<div class="col-sm-12">

					<div class="col-md-12">
						
						<ul class="nav navbar-nav">
							<li class="">
								<span>Filters:</span>
							</li>
							<li>
								<a href="{{ route('admin.employees.index') }}" class="">All</a>
							</li>
							<li class="active">
								<a class="active" href="{{ route('admin.employees.index', ['status'=>'actives']) }}">Actives</a>
							</li>
							<li>
								<a href="{{ route('admin.employees.index', ['status'=>'inactives']) }}">Inactives</a>
							</li>
							<li>
								<a href="{{ route('admin.employees.index', ['status'=>'inactives']) }}">Missing Card Ids</a>
							</li>
							<li>
								<a href="{{ route('admin.employees.index', ['status'=>'inactives']) }}">Missing Punch ID</a>
							</li>
							<li>
								<a href="{{ route('admin.employees.index', ['status'=>'inactives']) }}">Missing Photos</a>
							</li>
						</ul>
					</div><!-- /. Navigation -->

					<div class="col-md-7 pull-right">
						{!! Form::open(['route'=>['admin.employees.index'], 'method'=>'GET', 'id'=>'search_form', 'class'=>'', 'role'=>'form', 'autocomplete'=>"off"]) !!}		
							<div class="form-group">

								<div class="input-group">
							      <input 
							      	type="search" 
							      	name="search"
							      	id="inputSearch" 
							      	class="form-control"
							      	 required="required" 
							      	 title="Search employees" 
							      	placeholder="Search by name, ID or Phone"
							      >
							      <span class="input-group-btn">
							        <button class="btn btn-default" type="submit">
										<i class="fa fa-search"></i>
							        </button>
							      </span>
							    </div><!-- /. Input-group -->
							    <span class="help-block">Separate criterias by commas (,).</span>

							</div><!-- /. form group -->
						{!! Form::close() !!}
					</div><!-- /. Search box -->
				</div>
				<div class="col-sm-12">


					<div class="employees">			
						@include('employees._employees')
					</div>
					
				</div><!-- /. Primary box -->
		</div>
	</div>
@endsection



@section('scripts')
	<script>
		(function($){
			// applyDataTables();

			$(document).on('click', 'ul.pagination a', function(event) {
				event.preventDefault();
				var url = $(this).prop('href');
				var page = url.split('page=')[1];
				destiny = $('.employees');

				showLoading(destiny);

				performAjax(url, destiny);

			});

			$(document).on('submit', '#search_form', function(event){
				event.preventDefault();
				el = $(this);
				// data = el.serializeArray();
				query = $('#inputSearch').val();
				url = el.attr('action')+'?search='+query;
				destiny = $('.employees');

				showLoading(destiny);

				performAjax(url, destiny);
			});

			$(document).on('click', 'ul.navbar-nav>li>a', function(event){
				event.preventDefault();
				el = $(this);
				url = el.attr('href');
				destiny = $('.employees');

				showLoading(destiny);

				performAjax(url, destiny);
			});

			/**
			 * perform a ajax request and handle success or error
			 * @param  {string} url     the url request
			 * @param  {dom element} destiny the element where the result will be places
			 * @return {[type]}         [description]
			 */
			function performAjax(url, destiny){
				$.ajax({
					url: url,
					type: 'GET',
				})
				.done(function(data) {
					console.log(data);
					destiny.html(data);

					// applyDataTables();


				})
				.fail(function(error) {
					console.log(error);
					handleError(error);
				});

			}

			function showLoading(destiny)
			{
				return false;
				destiny.html('<div class="progress">'+
				  '<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">'+
				    '<span class="">Loading, please wait...</span>'+
				  '</div>'+
				'</div>');
			};

			function handleError(error)
			{
				if(error.status == 401){
					bootbox.alert("Session expired. Please log back in.", function(){
						location.reload();
					});

					setTimeout(function() {
						location.reload();
					}, 5000);
				    				
				}
			};

			function applyDataTables()
			{
				$('#employees-table').DataTable();
			}

		})(jQuery);

	</script>
	
@stop