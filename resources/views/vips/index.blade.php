@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Vip', 'page_description'=>'List of vips of production.'])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            @include('vips.partials.create')
        </div>

        <div class="col-md-8">
            @include('vips.partials.list')
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush