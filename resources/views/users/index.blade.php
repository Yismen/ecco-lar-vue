@inject('layout', 'App\Layout') 
@extends('layouts.'.$layout->app(), ['page_header'=>'Users', 'page_description'=>'Handle
the users configurations and setting.']) @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="row">
                <div class="col-sm-6">
                    <div class="box box-warning">
                        <div class="box-body">
                            <passport-clients></passport-clients>
                            <passport-authorized-clients></passport-authorized-clients>
                            <passport-personal-access-tokens></passport-personal-access-tokens>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="box box-primary">
                        <div class="box-body">
                            <users-registered></users-registered>
                        </div>
                    </div>
                </div>
            </div>
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
                                                <i class="fa fa-user"></i> {{ $user->name }}</a>
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
                    <div class="box box-primary">

                        <h3 class="box-header">
                            Users List
                            <a href="{{ route('admin.users.create') }}" class="pull-right">
                                <i class="fa fa-plus"></i>
                                Add New
                            </a>
                        </h3>

                        <div class="box-body">
                            @foreach ($users as $user)
                            <div class="col-sm-6">
                                <div class="box info-box bg-grey">
                                    <span class="info-box-icon">
                                        <a href="{{ route('admin.users.edit', $user->id) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">
                                            <a href="{{ route('admin.users.show', $user->id) }}">
                                                <i class="fa fa-user"></i>
                                                {{ $user->name }}
                                            </a>
                                        </span>
                                        {{--
                                        <span class="info-box-number">41,410</span> --}} @if (count($user->roles) > 0)
                                        <strong>Roles:</strong>
                                        @foreach ($user->roles as $role)
                                        <span class="label label-primary">{{ ucwords($role->name) }}</span>
                                        @endforeach @endif
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@stop @section('scripts') @stop