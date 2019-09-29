@extends('layouts.app', ['page_header'=>'Welcome', 'page_description'=>'Welcome page!', 'hide_content_header'=>false])
@section('content')
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

<div class="container-fluid">
    <h1 class="my-main-header"
    style="
        display: flex;
        font-weight: 500;
        font-size: 2.5rem;
        font-stretch: extra-expanded;
        text-transform: uppercase;
    ">
        <img src="{{ asset('images/logo.png') }}" alt="Image" height="30px">
        Welcome to {{ $app_name }}{{ isset($user) && $user->name ? ', ' . $user->name : '' }}
    </h1>

    <div class="row">
        <div class="col-sm-9">
            <div class="row">
                <div class="col-md-6">
                    @component('components.info-box', ['color' => 'bg-red', 'icon' => 'fa fa-users'])
                        Users
                        @slot('number')
                            {{ $users_count }}
                        @endslot
                    @endcomponent
                </div>

                <div class="col-md-6">
                    @component('components.info-box', ['color' => 'bg-red', 'icon' => 'fa fa-users'])
                        Sites
                        @slot('number')
                            {{ $sites }}
                        @endslot
                    @endcomponent
                </div>

                <div class="col-md-6">
                    @component('components.info-box', ['color' => 'bg-red', 'icon' => 'fa fa-users'])
                        Projects
                        @slot('number')
                            {{ $projects }}
                        @endslot
                    @endcomponent
                </div>

                <div class="col-md-6">
                    @component('components.info-box', ['color' => 'bg-red', 'icon' => 'fa fa-users'])
                        Employees
                        @slot('number')
                            {{ $employees_count }}
                        @endslot
                    @endcomponent
                </div>
            </div>

            <div class="row" >
                <div class="col-sm-12">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h4 class="no-margin">Latest Members</h4>
                        </div>

                        <div class="box-body" style="display: flex; flex-wrap: wrap; justify-content: space-around;">
                            @foreach ($profiles as $profile)
                                <div class="col-sm-4">
                                    <img
                                        src="{{ file_exists($profile->photo) ? asset($profile->photo) :  'http://placehold.it/300x300'}}"
                                        class="profile-user-img img-responsive img-circle" alt="Image"
                                    >

                                    <h5 class="profile-username text-center">
                                        <a href="{{ route('admin.profiles.show', $profile->id) }}" title="Visit {{ $profile->user->name }} Profile">
                                            {{ mb_strimwidth(optional($profile->user)->name, 0, 15, '...') }}
                                        </a>
                                    </h5>

                                    <p class="text-center help-block" style="font-size: 10px;">{{ strtoupper($profile->created_at->diffForHumans()) }}</p>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- {{ $profiles }} --}}
            </div>
        </div>
        <div class="col-sm-3">
            <h4>Your Apps</h4>
            @if ($user && $user->roles->count() > 0)
                @foreach ($user->roles as $role)
                    <div class="box box-primary" style="max-height: 200px; overflow-y: auto;">
                        <div class="box-header">
                            <h4>{{ personName($role->name) }}</h4>
                        </div>

                        <div class="box-body">
                            @if ($role->menus && $role->menus->count() > 0)
                                <div class="list-group">
                                    @foreach ($role->menus as $menu)
                                        <a href="/{{ $menu->name }}" class="list-group-item">{{ $menu->display_name }}</a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
