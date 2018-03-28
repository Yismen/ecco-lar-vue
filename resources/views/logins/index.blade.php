@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Logins', 'page_description'=>'List of logins for all the users.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3>
                            <div class="col-sm-6">
                                Logins Items List
                            </div>
                            <div class="col-sm-3">
                                <small>
                                    {!! Form::open(['url' => '/admin/logins/to_excel', 'method' => 'post', 'class'=>'', 'role' => 'form']) !!}

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <!-- Single button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-download"></i> Download <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><button type="submit" class="btn btn-link form-control"> All</button></li>
                                                    </ul>
                                                </div>
                                                
                                            </div>
                                        </div>

                                    {!! Form::close() !!}
                                </small>
                            </div>
                            <div class="col-sm-3">
                                <a href="{{ route('admin.logins.create') }}" class="pull-right">
                                    <small><i class="fa fa-plus"></i> Create</small>
                                </a>
                            </div>
                        </h3>
                    </div>

                    <div class="box-body">
                        @if ($employees->isEmpty())
                            <div class="bs-callout bs-callout-warning">
                                <h1>No Logins has been added yet, please add one</h1>
                            </div>
                        @else
                            @include('logins.partials.results', ['logins', $employees])
                        @endif
                    </div>

                    <div class="box-footer with-border">
                        {{ $employees->render() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection