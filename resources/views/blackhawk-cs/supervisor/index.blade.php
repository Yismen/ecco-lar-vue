@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'BlackHawk CS Supervisor Dashboard'])

@section('content')
    <div class="container-fluid">
        <transition name="router-animation" 
            enter-active-class="animated fadeInLeft" 
            leave-active-class="animated fadeOutLeft" 
            :duration="{ enter: 300, leave: 300 }" mode="out-in">

            <router-view name="blackhawk-cs-supervisor"></router-view> 
            <ol>
                <li>
                    QA
                    <ol>
                        <li>Top Ten and Botton Ten weekly</li>
                        {{--  <li>Top Ten and Botton Ten Monthly</li>  --}}
                    </ol>
                </li>
                <li>
                    TP
                    <ol>
                        <li>Top Ten and Botton Ten weekly</li>
                        {{--  <li>Top Ten and Botton Ten Monthly</li>  --}}
                    </ol>
                </li>
                <li>
                    AHT
                    <ol>
                        <li>Top Ten and Botton Ten weekly</li>
                        {{--  <li>Top Ten and Botton Ten Monthly</li>  --}}
                    </ol>
                </li>
                <li>
                    Wrap Up
                    <ol>
                        <li>Top Ten and Botton Ten weekly</li>
                        {{--  <li>Top Ten and Botton Ten Monthly</li>  --}}
                    </ol>
                </li>
                <li>
                    Utilization
                    <ol>
                        <li>Top Ten and Botton Ten weekly</li>
                        {{--  <li>Top Ten and Botton Ten Monthly</li>  --}}
                    </ol>
                </li>
                <li>
                    Efficiency
                    <ol>
                        <li>Top Ten and Botton Ten weekly</li>
                        {{--  <li>Top Ten and Botton Ten Monthly</li>  --}}
                    </ol>
                </li>
                <li>
                    Adheerence
                    <ol>
                        <li>Top Ten and Botton Ten weekly</li>
                        {{--  <li>Top Ten and Botton Ten Monthly</li>  --}}
                    </ol>
                </li>
            </ol>

        </transition> 
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/dainsys/app.js') }}"></script>
@endpush