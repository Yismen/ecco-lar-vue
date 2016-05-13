@extends('layouts.app', ['page_header'=>'Notes', 'page_description'=>'Notes List'])

@section('content')
	<div class="container">
    	<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<div class="box box-primary pad">
					
					<h1 class="page-header">
						<ol class="breadcrumb">
							<li>
								Notes List 
							</li>
							<li class="pull-right">
								<a href="{{ route('admin.notes.create') }}">
									<i class="fa fa-plus"></i>
									 Add
								</a>
							</li>
							<li class="pull-right">
								<a href="{{ route('admin.notes.trashed') }}">
									<i class="fa fa-check"></i>
									 Restore
								</a>
							</li>
						</ol>
					</h1>	

					<div class="notes-content">
						@include('notes.admin.partials.list')
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
