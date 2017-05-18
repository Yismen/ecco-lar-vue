@extends('layouts.app', ['page_header'=>'Situations', 'page_description'=>'Situation details'])

@section('content')
	<div class="container-fluid">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					<h1>Note {{ $note->title }}'s details</h1>

					<div class="form-group">
						{!! $note->body !!}
					</div>

					<div class="form-group">
						@foreach ($note->tagList as $tag)	
							<span class="label label-info">{{ ucwords($tag) }}</span>
						@endforeach
					</div>					

					<hr>

					<div class="form-group">
						<a class="btn btn-warning" href="{{ route('admin.notes.edit', $note->slug) }}">
							<i class="fa fa-edit"></i> Edit
						</a>
					</div>

					<div class="form-group">
						@include('notes.admin.partials.link-to-list')
					</div>
				</div>
			</div>
		</div>
	</div>
@stop