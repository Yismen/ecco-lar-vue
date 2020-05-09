@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Plugin Dev', 'page_description'=>'Test development'])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="box box-primary pad big-box">
                    {!! Form::open(['route'=>['test_plugin.data'], 'method'=>'POST', 'class'=>'', 'role'=>'form', 'autocomplete'=>"off", 'id'=>'test']) !!}      
                        <div class="form-group">
                            <legend>Form title</legend>
                        </div>
                        <div class="form-group">
                            <label for="">label</label>
                            <input type="text" class="form-control" name="new" placeholder="Input field">
                        </div>
                    
                        
                    
                        <button type="submit" class="btn btn-primary">Submit</button>
                    
                    {!! Form::close() !!}   
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">      

        ;(function($){
            $('form').myFormSubmit({
                resetForm: false,
                before: function(){
                    alert("Before Exe.");
                }, 
                callback: function() {
                    alert("Callback.")
                }
            });
        })(jQuery);
    </script>
@endpush