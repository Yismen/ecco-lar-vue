@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'BlackHawk CS Management Dashboard'])

@section('content')
    <div class="container-fluid">
        <transition name="router-animation" 
            enter-active-class="animated fadeInLeft" 
            leave-active-class="animated fadeOutLeft" 
            :duration="{ enter: 300, leave: 300 }" mode="out-in">

            <router-view name="blackhawk-cs-management"></router-view> 

        </transition> 
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/dainsys/app.js') }}"></script>
@endpush