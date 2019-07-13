@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Register to Dainsys', 'page_description'=>'New Users Registrations Page'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
                <div class="box box-primary">

                    {!! Form::open(['url'=>['register',], 'method'=>'POST', 'class'=>'', 'role'=>'form', 'autocomplete'=>"off"]) !!}

                        <div class="box-header with-border">
                            <h3>Register as a new member</h3>
                        </div>

                        <div class="box-body">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : null }}  has-feedback">
                                {!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Full Name']) !!}
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <!-- /. Name -->

                            <div class="form-group {{ $errors->has('email') ? 'has-error' : null }} has-feedback">
                                {!! Form::input('text', 'email', null, ['class'=>'form-control', 'placeholder'=>'Email Address']) !!}
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <!-- /. Email Address -->

                            <div class="form-group {{ $errors->has('username') ? 'has-error' : null }} has-feedback">
                                {!! Form::input('text', 'username', null, ['class'=>'form-control', 'placeholder'=>'User Name']) !!}
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                {!! $errors->first('username', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <!-- /. User Name -->

                            <div class="form-group {{ $errors->has('password') ? 'has-error' : null }} has-feedback">
                                {!! Form::input('password', 'password', null, ['class'=>'form-control', 'placeholder'=>'Password']) !!}
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <!-- /. Password -->

                            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : null }} has-feedback">
                                {!! Form::input('password', 'password_confirmation', null, ['class'=>'form-control', 'placeholder'=>'Retype Password']) !!}
                                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                {!! $errors->first('password_confirmation', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <!-- /. Retype Password -->
                            {{-- <div class="row">
                              <div class="col-xs-8">
                                <div class="checkbox icheck">
                                  <label>
                                    <input type="checkbox"> I agree to the <a href="#">terms</a>
                                  </label>
                                </div>
                              </div> --}}
                              <!-- /.col -->

                        </div>

                        <div class="box-footer">
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                            </div>

                            {{-- <div class="social-auth-links text-center">
                                <p>- OR -</p>
                                <hr>
                                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
                                Facebook</a>
                                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
                                Google+</a>
                            </div> --}}
                            <a href="{{ url('login') }}" class="text-center">I already have a membership</a>

                        </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop
