@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Users', 'page_description'=>'Handle the users configurations and setting.'])

@section('content')
    <div class="container">
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
                    @if ($users->isEmpty())
                        <div class="bs-callout bs-callout-warning">
                            <h1>
                                No Menus has been added yet, please add one
                            </h1>
                        </div>
                    @else
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
                        
                        {{ $users->render() }}

                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    
@stop
