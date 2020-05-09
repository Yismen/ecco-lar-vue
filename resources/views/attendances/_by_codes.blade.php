@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config('dainsys.app_name'), 'page_description'=>'Edit Attendance '])

@section('content')
    <div class="col-sm-8 col-sm-offset-2">
        <div class="box box-primary">
            <div class="box-header">
                <h4>
                    Search by Codes:
                    <a href="{{ route('admin.attendances.index') }}" class="pull-right">
                        <i class="fa fa-home"></i> List
                    </a>
                </h4>
            </div>

            <div class="box-body" style="max-height: 200px; overflow-y: auto;">
                @foreach ($codes as $code)
                    @if ($code->id == request()->route()->parameters('code')['code'])
                        <a href="#" class="btn btn-xs btn-primary">
                            {{ $code->name }}
                        </a>
                    @else                        
                        <a href="{{ route('admin.attendances.code', $code->id) }}" 
                            class="btn btn-xs btn-default">
                            {{ $code->name }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
	<div class="col-sm-12">
        <div class="col-lg-3 col-xs-6">
            @include('attendances._code', [
                'title' => 'This Week!',
                'color' => 'bg-blue',
                'code' => $code->id,
                'count' => $data['this_week']->count()
            ])
        </div>
        <div class="col-lg-3 col-xs-6">
            @include('attendances._code', [
                'title' => 'Last Week!',
                'color' => 'bg-blue',
                'count' => $data['last_week']->count()
            ])
        </div>
        <div class="col-lg-3 col-xs-6">
            @include('attendances._code', [
                'title' => 'This Month!',
                'color' => 'bg-green',
                'count' => $data['this_month']->count()
            ])
        </div>
        <div class="col-lg-3 col-xs-6">
            @include('attendances._code', [
                'title' => 'Last Month!',
                'color' => 'bg-green',
                'count' => $data['last_month']->count()
            ])
        </div>
        <div class="col-lg-3 col-xs-6">
            @include('attendances._code', [
                'title' => 'Two Months Ago!',
                'color' => 'bg-green',
                'count' => $data['two_months_ago']->count()
            ])
        </div>
        <div class="col-lg-3 col-xs-6">
            @include('attendances._code', [
                'title' => 'Year to Date!',
                'color' => 'bg-yellow',
                'count' => $data['year_to_date']->count()
            ])
        </div>
	</div>

@stop

@push('scripts')
	
@endpush