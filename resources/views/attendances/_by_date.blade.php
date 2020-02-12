@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'Edit Attendance '])

@section('content')
    @include('attendances._dates')

	<div class="col-sm-12">
        @foreach ($codes as $code)
            <div class=" col-xs-6 col-md-4 col-lg-3">
                <div class="small-box">
                    <div class="inner" style="background-color: {{ $code->color }} ;">
                        <h3>
                            {{ $code->attendances_count }} 
                            <sup style="font-size: 20px">
                                {{ 
                                    $codes->sum('attendances_count') > 0 ?
                                        number_format($code->attendances_count / $codes->sum('attendances_count') * 100, 0)  :
                                        0
                                }}%
                            </sup>   
                        </h3>

                        <p>{{ $code->name }}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-"></i>
                    </div>
                    <a href="{{ route('admin.attendances.date.code', [request()->route()->parameters['date'], $code->id]) }}" class="small-box-footer"
                        style="background-color: gray;" target="_attendances"
                    >
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        @endforeach
	</div>

@stop

@section('scripts')
	
@stop