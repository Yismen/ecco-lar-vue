@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Users', 'page_description'=>'Reset a user\'s password and assign a new one.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h4>
                            Reset Password to {{ $user->name }} 
                            <a href="/admin/users" class="pull-right">
                                <i class="fa fa-users"></i> 
                                Users List
                            </a>
                        </h4>
                    </div>

                    {!! Form::open(['route'=>['admin.users.force_change', $user->id], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}   
                        <div class="box-body">

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <strong><i class="fa fa-italic"></i> Name:</strong> {{ $user->name }} <br>
                                    <strong><i class="fa fa-envelope"></i>Email:</strong>  {{ $user->email }} <br>
                                    @if (session('new_password')) 
                                        <h3><strong><i class="fa fa-envelope"></i> New Password: </strong>{{ session('new_password') }}</h3>
                                    @endif
                                </div>
                            </div>
    
                            @if ( $errors->has('error'))
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="alert alert-danger">
                                            <strong>No Way!</strong> {!! $errors->first('error', '<span class="">:message</span>') !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <!-- /.  --><hr>
                            
                            <div class="form-group has-error">  
                                {!! Form::label('notify', 'Notify:', ['class'=>'col-sm-2 control-label']) !!}
                                <div class="col-sm-10">     
                                    <div class="checkbox">
                                        <label>
                                            {!! Form::checkbox('notify', 1, 1, []) !!}
                                            Notify the user
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- /. Notify -->   
                        </div>

                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-danger" type="submit">
                                        <i class="fa fa-key"></i>
                                        Generate a new password for this user!
                                    </button>
                                </div>
                            </div>   
                        </div>
                    {!! Form::close() !!}
                    
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush