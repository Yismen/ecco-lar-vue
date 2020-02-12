@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'Edit Attendance '])

@section('content')
    <div class="col-sm-8 col-sm-offset-2">
        <div class="box box-primary">
            <div class="box-header">
                <h4>
                    Search by Date:
                    <a href="{{ route('admin.attendances.index') }}" class="pull-right">
                        <i class="fa fa-home"></i> List
                    </a>
                </h4>
            </div>

            <div class="box-body" style="max-height: 200px; overflow-y: auto;">
                @foreach ($dates as $item)
                    <a href="{{ route('admin.attendances.date', $item->date) }}" 
                        class="btn btn-xs {{ $item->date == request()->route()->parameters('date')['date'] ? 'btn-primary' : 'btn-default' }}">
                        {{ $item->date }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
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
                    <a href="{{ route('admin.attendances.code', $code->id) }}" class="small-box-footer"  style="background-color: gray;">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        @endforeach
	</div>

@stop

@section('scripts')
	
@stop