@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>config("dainsys.app_name"), 'page_description'=>'Edit Existing Nationality.'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary">

                    {!! Form::model($nationality, ['route'=>['admin.nationalities.update', $nationality->id], 'method' => 'PUT', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}       
                        <div class="box-header with-border">
                            <h4>
                                Edit Nationality {{ $nationality->name }}
                                <a href="{{ route('admin.nationalities.index') }}" class="pull-right" title="Back to Main Page"><i class="fa fa-list"></i></a>
                            </h4>
                        </div>
                        {{-- /. .box-header --}}
                        <div class="box-body">
                            @include('nationalities._form')                        
                        </div>
                        {{-- /. .box-body --}}
                        <div class="box-footer">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="reset" class="btn btn-default">CANCEL</button>
                                    <button type="submit" class="btn btn-warning">UPDATE</button>
                                </div>
                            </div>
                    
                            {!! Form::close() !!}
                            <div class="col-sm-12">                        
                                <div class="form-group">
                                    <form action="{{ url('/admin/nationalities', $nationality->id) }}" method="POST" class="" style="display: inline-block;">
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                    
                                        <button type="submit" id="delete-nationalities" class="btn btn-danger"  name="deleteBtn">
                                            <i class="fa fa-btn fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                            {{-- /. Delete Form  --}}
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@stop