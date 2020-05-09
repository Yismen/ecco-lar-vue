@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Universal', 'page_description'=>'List of Universals of production.'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            @include('universals.partials.create')
        </div>

        <div class="col-md-8">
            @include('universals.partials.list')
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush
