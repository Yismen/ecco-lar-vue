@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Sources', 'page_description'=>'List of sources of production.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary pad">
                    
                    <transition
                            enter-active-class="slideInLeft"
                            {{-- enter-class="slideInLeft"
                            leave-class="fadeOut" --}}
                            leave-active-class="fadeOutUp"
                        >
                        <router-view class="animated"></router-view>
                    </transition>

                    <transition
                            enter-active-class="fadeInLeft"
                            {{-- enter-class="slideInLeft" --}}
                            {{-- leave-class="fadeOut" --}}
                            leave-active-class="fadeOutUp"
                        >
                        <router-view name="sources" class="animated"></router-view>
                    </transition>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@stop