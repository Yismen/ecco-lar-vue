@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Arss', 'page_description'=>'Arss list!'])

@section('content')
	<div class="container-fluid">
    	<form action="/admin/arss/employees" method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <h3>
                        Arss List
                        <a href="/admin/arss/create" class="pull-right"><i class="fa fa-plus"></i> Add</a>
                    </h3>

                    @if ($free_employees->count() > 0)
                        <div class="box box-danger">
                            <div class="box-header">
                                <h4>
                                    List of Employees Not Assigned to Any Arss
                                    <span class="badge bg-yellow">{{ $free_employees->count() }}</span>
                                </h4>
                            </div>
                            <div class="box-body">
                                <table class="table table-condensed table-hover">
                                    <tbody>
                                        @foreach ($free_employees as $employee)
                                            <tr is="employee-row" :employee="{{ $employee }}"  class="col-lg-3 col-md-4 col-sm-6"/>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-sm-10 col-sm-offset-1">
                    @foreach ($arss as $ars)
                        @if ($ars->employees->count() > 0)
                            <div class="box box-warning">
                                <div class="box-header">
                                    <h4>
                                        <a href="{{ route('admin.arss.show', $ars->id) }}">{{ $ars->name }}</a>
                                        <span class="badge bg-yellow">{{ $ars->employees->count() }}</span>
                                        <a href="{{ route('admin.arss.edit', $ars->id) }}" class="pull-right text-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </h4>
                                </div>

                                <div class="box-body">
                                    <table class="table table-condensed table-hover">
                                        <tbody>
                                            @foreach ($ars->employees as $employee)
                                                <tr is="employee-row" :employee="{{ $employee }}" class="col-lg-3 col-md-4 col-sm-6">
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-sm-3 col-xs-7" style="position: fixed; bottom: 35%; right: 30px; padding: 15px ;  background-color: whitesmoke; border: darkgray; border-style: solid; border-width: thin;">
                <div class="input-group">
                    {{ Form::select('ars', $arss->pluck('name', 'id'), null, ['class' => 'form-control']) }}
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-warning">Re-Assign</button>
                    </span>
                </div>
                @include('layouts.partials.errors')
            </div>
        </form>
	</div>
@stop

@section('scripts')
@stop
