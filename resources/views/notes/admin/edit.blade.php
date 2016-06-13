@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-sm-8 col-sm-offset-2">
                <div class="box box-primary pad">
                    
                    {!! Form::model($note, ['route'=>['admin.notes.update', $note->slug], 'method'=>'PATCH', 'class'=>'', 'role'=>'form', 'autocomplete'=>"off"]) !!}       
                        <div class="form-group">
                            <legend>Update Note {{  $note->name }}</legend>
                        </div>
                    
                        @include('notes.admin._form')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update</button>
                            <button class="btn btn-default" type="reset">Reset</button>
                            
                        </div>
                    
                    {!! Form::close() !!}
                    
                    {!! deleteForm('admin.notes.destroy', $note->slug) !!}
                    <div class="form-group">
                        @include('notes.admin.partials.link-to-list')
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection