@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Users', 'page_description'=>'Handle the users configurations and setting.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-primary pad col-sm-12">

                    <h3 class="page-header">
                        Users List    
                        <a href="{{ route('admin.users.create') }}" class="pull-right">
                            <i class="fa fa-plus"></i>
                             Add New
                        </a>                     
                    </h3>
                    {{-- /. Header --}}
                        
                    @if ($users->isEmpty())
                        <div class="bs-callout bs-callout-warning">
                            <h1>
                                No Menus has been added yet, please add one
                            </h1>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

                                    <div class="info-box-content">
                                    <span class="info-box-text">Active Users</span>
                                    <span class="info-box-number">{{ $users->total() }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                    </div>
                                </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed iste nihil, porro nam tempore delectus! Quaerat incidunt ea ratione in maiores sequi facere maxime ipsam, quo molestias ut minima repellat.</div>
                            <div class="col-md-4 col-sm-6 col-xs-12">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora, blanditiis dicta laboriosam perspiciatis animi, cumque voluptates, quia aliquam quos quaerat architecto! Hic qui temporibus et iusto perspiciatis tenetur ducimus repellat?</div>
                        </div>
                        {{-- ./ Dashboard --}}
                        <div class="row">
                            @foreach ($users as $user)
                                <div class="div col-sm-6">
                                    <div class="box info-box bg-grey">
                                        <span class ="info-box-icon">
                                            <a href="{{ route('admin.users.edit', $user->id) }}">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </span>
                                        <div class ="info-box-content">
                                            <span class ="info-box-text">
                                                <a href="{{ route('admin.users.show', $user->id) }}">
                                                    <i class="fa fa-user"></i>
                                                     {{ $user->name }}
                                                </a>
                                            </span>
                                            {{-- <span class ="info-box-number">41,410</span> --}}
                                            
                                            @if (count($user->roles) > 0)
                                                <strong>Roles:</strong>
                                                @foreach ($user->roles as $role)
                                                    <span class="label label-primary">{{ $role->display_name }}</span>
                                                @endforeach
                                            @endif
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                {{ $users->render() }}
                            </div>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    
@stop
