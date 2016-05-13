@extends('layouts.main')

@section('content')
	<div class="container">
		<br>
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
				<div class="well">
					@include('tasks.create')
					<table class="table table-condensed table-hover">
						<thead>
							<tr>
								<th>Task Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach( $tasks as $task )
								<tr>
									<td>
										<label id="{{ $task->id }}" class="parent {{ $task->completed ? 'completed' : '' }}">
											{!! Form::open(['route'=>['ajaxUpdate'], 'method'=>'GET', 'class'=>'', 'role'=>'form']) !!}	

												{!! Form::checkbox('completed', 1, $task->completed ) !!}
												{{ $task->task_name }}	

											{!! Form::close() !!}
										</label>
									</td>
									<td class="col-xs-2">
										{!! delete_form_x( ['tasks.destroy', $task->id] ) !!}
									</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<td colspan="10">{!! $tasks->render() !!}</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		<!-- /. Main Row -->
	</div>
	<!-- /. Main container -->
@stop

@section('scripts')
	<script>
		$('input[name=task_name]').focus();
	</script>
	<script src="{{ asset('js/scripts/tasks.js') }}"></script>
    <script src="{{ asset('plugins/bootbox/bootbox.min.js') }}"></script>
@stop