@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Logins', 'page_description'=>'List of login_names for all the users.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h4>
                            <div class="col-xs-8">
                                Logins Items List
                            </div>
                            <div class="col-xs-4">
                                <a href="{{ route('admin.login-names.create') }}" class="">
                                    <i class="fa fa-plus"></i> Create
                                </a>

                                <div role="presentation" class="dropdown pull-right">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-download"></i>
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="li">
                                            <a href="{{ route('admin.login-names.to-excel.all-employees') }}">
                                                <i class="fa fa-file-excel-o"></i> All Employees
                                            </a>
                                        </li>
                                        <li class="li">
                                            <a href="{{ route('admin.login-names.to-excel.all') }}">
                                                <i class="fa fa-file-excel-o"></i> All Login Names
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                {{-- ./ Download button --}}
                            </div>
                        </h4>
                    </div>

                    <div class="box-body">
                        @if ($employees->isEmpty())
                            <div class="bs-callout bs-callout-warning">
                                <h1>No Logins has been added yet, please add one</h1>
                            </div>
                        @else
                            @include('login_names.partials.results', ['login_names', $employees])
                        @endif
                    </div>

                    <div class="box-footer with-border">
                        {{ $employees }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection