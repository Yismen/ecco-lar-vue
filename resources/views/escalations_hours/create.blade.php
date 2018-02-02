@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Escalations Hours', 'page_description'=>'Add a new Escalations Record!'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">
                    
                    <div class="box-header with-border"><h4>Create Hours</h4></div>
                    
                    <div class="box-body">
                        <table class="table table-condensed table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>Records:</th>
                                    <th>Production Hours:</th>
                                    <th>Productivity:</th>
                                </tr>
                                <tr class="text-center">
                                    <td>{{ $record->count }}</td>
                                    <td>0</td>
                                    <td>0.00</td>
                                </tr>
                            </tbody>
                        </table>
                        {!! Form::open(['route'=>['admin.escalations_hours.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}       
                    
                            @include('escalations_hours._form')
                    
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">CREATE</button>
                                <button type="reset" class="btn btn-default">CANCEL</button>
                            </div>
                    
                        {!! Form::close() !!}
                    </div>  
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{-- <script src="/js/app.js"></script> --}}
@stop