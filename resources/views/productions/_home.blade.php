<div class="com-sm-12 ">
		<h3 class="page-header">
			Productions Items List
			 (
				 	<a href="{{ route('admin.productions.create') }}">
				 		<i class="fa fa-plus"></i>
				 	</a>
			 )
		</h3>
		<ul>
			<li>A form to search</li>
			<li>Use partials from downtimes to search data</li>
		</ul>
	@if ($productions->isEmpty())
		<div class="bs-callout bs-callout-warning">
			<h1>No Productions has been added yet, please add one</h1>
		</div>
	@else
		@include('productions._table')
	@endif
</div>