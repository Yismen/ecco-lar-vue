@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'Edit Attendance '])

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('attendances._dates')
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h5>List of employees {{ request()->route()->parameters['code']->name }} on {{ request()->route()->parameters['date'] }} </h5>
                    </div>

                    <div class="box-body">
                        @foreach ($employees->chunk(number_format($employees->count()/2, 0)) as $chunk)
                            <div class=" col-xs-12 col-sm-6">
                                <table class="table table-condensed table-hover table-bordered">
                                    <tbody>
                                        @foreach ($chunk as $el)
                                            <tr style="background-color: {{ request()->route()->parameters['code']->color }} ">
                                                <td>
                                                    <a href="{{ route('admin.attendances.employee', $el->employee->id) }} ">
                                                        {{ $el->employee->full_name }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@stop

@section('scripts')
	
@stop