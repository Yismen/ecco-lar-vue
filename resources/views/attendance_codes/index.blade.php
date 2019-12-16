@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Attendance Codes', 'page_description'=>'List of attendance codes.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-lg-4">
                    @include('attendance_codes.create')
            </div>
            
            <div class="col-xs-12 col-lg-8">
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendance_codes as $code)
                                    <tr>
                                        <td>{{ $code->name }}</td>
                                        <td style="background-color: {{ $code->color }};">{{ $code->color }}</td>
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

@section('scripts')
@stop
