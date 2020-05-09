@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Aproved notes for emails and chats'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <transition name="fade">

                    <router-view name="notes"></router-view>
                    <router-view></router-view>

                </transition>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush