<style>
	#searchByValue, #searchRange {
		display: none;
	}
</style>
<div class="navbar navbar-defaults">
	<a class="navbar-brand" href="#">
		<span class="fa fa-dashboard"></span>
	</a>
	<ul class="nav navbar-nav navbar-right">
		<li>
			<a href="{{ route('admin.downtimes.create') }}">
				Add Down Time
				 <i class="fa fa-plus"></i>
			</a>
		</li>
	</ul>
</div>


	<hr>

	<div class="">
		{!! Form::open(['route'=>['admin.downtimes.searchScope'], 'method'=>'GET', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}
			<div class="form-group form-group-sm">
				<label for="search_date" class="col-sm-2 control-label">Search Values:</label>
				<div class="col-sm-10">
					<div class="input-group">
						<select name="search_date" id="inputSearch_date" class="form-control">
							<option value="today">Today</option>
							<option value="yesterday">Yesterday</option>
							<option value="this week">This Week</option>
							<option value="last week">Last Week</option>
							<option value="thisMonth">This Month</option>
							<option value="lastMonth">Last Month</option>
							<option value="thisYear">This Year</option>
							<option value="lastYear">Last Year</option>
							<option value="thisMany">This Many</option>
							<option value="range">From Date to Date</option>
						</select>

	     				<span class="input-group-btn">
							<button type="submit" class="btn btn-default">
								 <i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</div>
			</div>
		{!! Form::close() !!}
	</div>

	<div class="">
		{!! Form::open(['route'=>['admin.downtimes.searchByValue'], 'method'=>'GET', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off", 'id'=>'searchByValue']) !!}	

				<div class="form-group form-group-sm">
					<label for="search_value" class="col-sm-2 control-label">Search Date:</label>
					<div class="col-sm-10">
						<div class="col-xs-3">
							<input type="number" name="value" id="inputValue" class="form-control" value="0" min="0" max="200" step="" required="required" title="">
						</div>
						<div class="input-group">
							<select name="search_value" id="inputsearch_value" class="form-control">
								<option value="days">Days Ago</option>
								<option value="weeks">Weeks Ago</option>
								<option value="months">Months Ago</option>
								<option value="years">Years Ago</option>
							</select>

		     				<span class="input-group-btn">
								<button type="submit" class="btn btn-default">
									 <i class="fa fa-search"></i>
								</button>
							</span>
						</div>
					</div>
				</div>
		{!! Form::close() !!}
	</div>
		{!! Form::open(['route'=>['admin.downtimes.searchRange'], 'method'=>'GET', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off", 'id'=>'searchRange']) !!}	
				<div class="form-group form-group-sm">
					<div class="col-sm-5">
						<div class="form-group">
							<label for="inputFromDate" class="col-sm-2 control-label">From Date:</label>
							<div class="col-sm-10">
								<input type="date" name="fromDate" id="inputFromDate" class="form-control" value="{{ date('Y-m-d', strtotime('today')) }}" required="required" title="">
							</div>
						</div>
					</div>
					<div class="col-sm-5">
						<div class="form-group">
							<label for="inputToDate" class="col-sm-2 control-label">To Date:</label>
							<div class="col-sm-10">
								<input type="date" name="toDate" id="inputToDate" class="form-control" value="{{ date('Y-m-d', strtotime('today')) }}" required="required" title="">
							</div>
						</div>
					</div>
					<div class="col-sm-2">
						
							<button type="submit" class="btn btn-default">
								 <i class="fa fa-search"></i>
							</button>
					</div>
				</div>
		{!! Form::close() !!}

	<script>
		jQuery(document).ready(function($) {
			/**
			 * Show the search value form and search range forms when the input search is updated
			 */
			$(document).on('change', '#inputSearch_date', function(event) {
				event.preventDefault();
				/* Act on the event */
				var value = $(this).val();

				console.log(value)

				if (value == 'thisMany') {
					$('#searchByValue').fadeIn('slow');
				} else{
					$('#searchByValue').fadeOut('fast');
				}

				if (value == 'range') {
					$('#searchRange').fadeIn('slow');
				} else{
					$('#searchRange').fadeOut('fast');
				};
			});


			/**
			 * change the inputValue max property depending on the selected inputSearch_date
			 */
			$(document).on('change', '#inputsearch_value', function(event) {
				event.preventDefault();
				
				var value = $(this).val();
				var element = $('#inputValue');

				switch(value) {
					case('days'): element.prop('max', 200);
						break;
					case('weeks'): element.prop('max', 10);
						break;
					case('months'): element.prop('max', 20);
						break;
					case('years'): element.prop('max', 2);
						break;
				}
			});
		});
	</script>