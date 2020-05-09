@extends('layouts.app')

@section('content')
	<div class="container-fluid">
		<br>
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				<div class="well">
					{{-- @include('tasks.create') --}}
					<my-tasks></my-tasks>
				</div>
			</div>
		</div>
		<!-- /. Main Row -->
	</div>
	<!-- /. Main container -->
@stop

@push('scripts')
	<script>
		$('input[name=task_name]').focus();
	</script>
	<script src="{{ asset('js/scripts/tasks.js') }}"></script>
    <script src="{{ asset('plugins/bootbox/bootbox.min.js') }}"></script>
@endpush