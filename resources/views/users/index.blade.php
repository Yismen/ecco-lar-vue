@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Users', 'page_description'=>'Handle
the users configurations and setting.']) @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="row">
                <div class="col-md-3">
                    @if (isset($users))
                        <div class="box box-success">
                            <div class="box-header">
                                <h4>Online Users</h4>
                            </div>

                            <ul class="list-group">
                                @foreach ($users as $user)
                                    @if ($user->isOnline())
                                        <li class="list-group-item">
                                            <a href="{{ route('admin.profiles.show', $user->id) }}">
                                                <i class="fa fa-user"></i> {{ $user->name }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <div class="box box-primary">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua">
                                    <i class="fa fa-users"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Active Users</span>
                                    <span class="info-box-number">{{ $users->count() }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-9">
                    <h3>
                        Users List
                        <a href="{{ route('admin.users.create') }}" class="pull-right">
                            <i class="fa fa-plus"></i>
                            Add New
                        </a>
                    </h3>
                    <div class="row">
                        @foreach ($users as $user)
                            <div class="col-sm-6">
                                <div class="box box-primary info-box bg-grey">
                                    <span class="info-box-icon">
                                        @if (file_exists(optional($user->profile)->photo))
                                            <a href="{{ asset($user->profile->photo) }}" target="_user_photo">
                                                <img src="{{ asset($user->profile->photo) }}"
                                                    class="profile-user-img img-responsive img-circle img-thumbnail" alt="Image"
                                                >
                                            </a>
                                        @else
                                            <img src="http://placehold.it/300x300"
                                                class="profile-user-img img-responsive img-circle img-thumbnail" alt="Image"
                                            >
                                        @endif
                                    </span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">
                                            <a href="{{ route('admin.users.show', $user->id) }}">
                                                <i class="fa fa-user"></i>
                                                {{ $user->name }} 
                                            </a>
                                            <i 
                                                class="fa fa-circle {{ $user->isOnline() ? 'text-green' : 'text-gray'}}"
                                                title="{{ $user->isOnline() ? 'Online' : 'Away'}}"
                                            ></i>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="pull-right">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </span>

                                        {{-- <span class="info-box-number">41,410</span> --}}
                                         @if (count($user->roles) > 0)
                                            <strong>Roles:</strong>
                                            @foreach ($user->roles as $role)
                                                <span class="label label-primary">{{ ucwords($role->name) }}</span>
                                            @endforeach
                                        @endif
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
            {{-- /.row --}}
            <div class="row">
                <div class="col-sm-12">
                    <h3>OAuth API Users</h3>

                    <div class="box box-warning">
                        <div class="box-body">
                            <passport-clients></passport-clients>
                        </div>
                    </div>
                    {{-- /.box --}}

                    <div class="box box-warning">
                        <div class="box-body">
                            <passport-personal-access-tokens></passport-personal-access-tokens>
                        </div>
                    </div>
                    {{-- /.box --}}

                    <div class="box box-warning">
                        <div class="box-body">
                            <passport-authorized-clients></passport-authorized-clients>
                        </div>
                    </div>
                    {{-- /.box --}}
                </div>
            </div>
            {{-- /.row --}}
        </div>
    </div>
</div>
@stop
@section('scripts')

@stop
