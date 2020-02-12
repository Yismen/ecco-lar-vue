@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'Edit Attendance '])

@section('content')
    <div class="col-sm-8 col-sm-offset-2">
        <div class="box box-primary">
            <div class="box-header">
                <h4>
                    {{ $employee->full_name }} Attendances last 2 months:
                    <a href="{{ route('admin.attendances.index') }}" class="pull-right">
                        <i class="fa fa-home"></i> List
                    </a>
                </h4>
            </div>

            <div class="box-body" >
                @foreach ($data as $code)
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box" style="height: 200px; overflow-y: auto; background-color: {{ $code->color }}">
                            <div class="inner">
                                <h3>{{ $code->attendances->count() }}</h3>
                    
                                <p>{{ $code->name }}</p>
                            </div>
                            {{-- <div class="icon">
                                <i class="fa fa-bar-chart"></i>
                            </div> --}}
                            <div class="small-box-footer">
                                @foreach ($code->attendances as $attendance)
                                    <span class="label bg-black text-sm">{{ $attendance->date }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop

@section('scripts')
	
@stop