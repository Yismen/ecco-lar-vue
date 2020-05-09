@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Attendance Codes', 'page_description'=>'List of attendance codes.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-lg-5">
                    @include('attendance_codes.create')
            </div>
            
            <div class="col-xs-12 col-lg-7">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h4>
                            Attendance Codes List
                        </h4>
                    </div>

                    <div class="box-body">
                        
                        <table class="table table-condensed table-hover table-bordered">
                            <thead>
                                <tr>    
                                    <th>Code</th>    
                                    <th>Color</th>
                                    <th>Absence</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendance_codes as $code)
                                    <tr style="background-color: {{ $code->color }};">
                                        <td>{{ $code->name }}</td>
                                        <td>{{ $code->color }}</td>
                                        <td>{{ $code->absence ? "Yes" : "No" }} </td>
                                        <td>
                                            <a href="{{ route('admin.attendance_codes.edit', $code->id) }}" class="text-warning">
                                                <i class="fa fa-pencil"></i> 
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
