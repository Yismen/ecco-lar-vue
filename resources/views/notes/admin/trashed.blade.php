@extends('layouts.app', ['page_header'=>'Notes', 'page_description'=>'Trashed notes'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					@if ($notes && count($notes) >0)
						<ul class="list-group">
							@foreach ($notes as $note)
								<li class="list-group-item">
									<h4>{{ $note->title }}
									<a href="{{ route('admin.notes.restore', $note->slug) }}" class="btn btn-info pull-right">
										<i class="fa fa-check"></i>
										 Restore
									</a>
									</h4>
								</li>
							@endforeach
						</ul>
					@else
						<h4 class="alert alert-info">
							No deleted notes to restore.
						</h4>
					@endif

					@include('notes.admin.partials.link-to-list')
				</div>
			</div>
		</div>
	</div>
@stop