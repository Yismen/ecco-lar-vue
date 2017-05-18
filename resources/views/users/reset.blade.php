@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Reset Password', 'page_description'=>'Allow a current user to reset password'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary pad">
                    {!! Form::open(['route'=>['admin.users.change'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}  
                        <legend>Reset your password</legend>
                    
                        <!-- Your Old Password -->
                        <div class="form-group {{ $errors->has('old_password') ? 'has-error' : null }}">
                            {!! Form::label('old_password', 'Your Old Password:', ['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::input('password', 'old_password', null, ['class'=>'form-control', 'placeholder'=>'Your Old Password']) !!}        
                                {!! $errors->first('old_password', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <!-- /. Your Old Password -->

                        <!-- Your New Password -->
                        <div class="form-group {{ $errors->has('new_password') ? 'has-error' : null }}">
                            {!! Form::label('new_password', 'Your New Password:', ['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::input('password', 'new_password', null, ['class'=>'form-control', 'placeholder'=>'Your New Password']) !!}        
                                {!! $errors->first('new_password', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <!-- /. Your New Password -->

                        <!-- Confirm New Password -->
                        <div class="form-group {{ $errors->has('new_password_confirmation') ? 'has-error' : null }}">
                            {!! Form::label('new_password_confirmation', 'Confirm New Password:', ['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::input('password', 'new_password_confirmation', null, ['class'=>'form-control', 'placeholder'=>'Confirm New Password']) !!}        
                                {!! $errors->first('new_password_confirmation', '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <!-- /. Confirm New Password -->

                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary">SAVE CHANGE</button>
                                <a class="btn btn-default" href="/admin">Cancel <i class="fa fa-home"></i></a>
                            </div>
                        </div>
                    
                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop