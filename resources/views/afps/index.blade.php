@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'AFPs', 'page_description'=>'AFPs list!'])

@section('content')
    <div class="container-fluid">
        <form action="/admin/afps/employees" method="POST">
            @csrf
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <h3>
                        AFPs List
                        <a href="/admin/afps/create" class="pull-right"><i class="fa fa-plus"></i> Add</a>
                    </h3>

                    @if ($free_employees->count() > 0)
                        <div class="box box-danger">
                            <div class="box-header">
                                <h4>
                                    List of Employees Not Assigned to Any AFPs
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
                    @foreach ($afps as $afp)
                        @if ($afp->employees->count() > 0)
                            <div class="box box-warning">
                                <div class="box-header">
                                    <h4>
                                        <a href="{{ route('admin.afps.show', $afp->id) }}">{{ $afp->name }}</a>
                                        <span class="badge bg-yellow">{{ $afp->employees->count() }}</span>
                                        <a href="{{ route('admin.afps.edit', $afp->id) }}" class="pull-right text-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </h4>
                                </div>

                                <div class="box-body">
                                    <table class="table table-condensed table-hover">
                                        <tbody>
                                            @foreach ($afp->employees as $employee)
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
                    {{ Form::select('afp', $afps->pluck('name', 'id'), null, ['class' => 'form-control']) }}
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
