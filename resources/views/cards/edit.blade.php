@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Cards', 'page_description'=>'Edit card id.'])

@section('content')
	<div class="col-sm-8 col-sm-offset-2">
		<div class="box box-primary pad">

			{!! Form::model($card, ['route'=>['admin.cards.update', $card->card], 'method'=>'PUT', 'class'=>'form-horizontal', 'role'=>'form']) !!}

				<legend>Edit Card ID {{ $card->card }}</legend>

				@include('cards._form')

				<div class="form-group">
					<div class="col-sm-6 col-sm-offset-2">
						<button type="submit" class="btn btn-primary">Update</button>
						<a href="{{ route('admin.cards.index') }}" class="btn btn-default">Cancel</a>
					</div>
				</div>

			{!! Form::close() !!}

			<delete-request-button
			    url="{{ route('admin.cards.destroy', $card->card) }}"
			    redirect-url="{{ route('admin.cards.index') }}"
			></delete-request-button>

		    <div class="form-group col-sm-offset-4">
		    	<a href="/admin/cards" class="push-right">
		    		Back to the list
			    	<i class="fa fa-list"></i>
			    </a>
		    </div>

		</div>
	</div>
@endsection
@push('scripts')

@endpush