@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Downtime', 'page_description'=>'Manage downtimes'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary pad row">
                    <h3 class="page-header">
                        Down Time Reports
                    </h3>
                    <div class="col-sm-12"> 

                        {!! Form::open(['route'=>['admin.downtimes.import'], 'method'=>'POST', 'class'=>'', 'role'=>'form', 'autocomplete'=>"off"]) !!}      
                        
                            <div class="form-group {{ $errors->has('insert_date') ? 'has-error' : null }}">
                                {!! Form::label('insert_date', 'Search By Insert Date:', ['class'=>'']) !!}
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                    {!! Form::input('date', 'insert_date', null, ['class'=>'form-control', 'placeholder'=>'Search By Insert Date']) !!}
                                </div>
                            </div>
                            <!-- /. Search By Insert Date -->
                            
                        
                        {!! Form::close() !!}

                    </div>
                    <div class="col-sm-12">Edit / Create form</div>

                    <hr>    

                    <div class="row" id="results">
                        <div class="col-sm-12">
                            @if (isset($downtimes))                            
                                @include('downtimes._results-table', ['downtimes' => $downtimes])
                                {{-- @include('downtimes._results', ['downtimes' => $downtimes]) --}}
                            @else
                                <div class="alert bg-yellow">
                                    <h3>Please Select a Date to Look for Data.</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('form').myFormSubmit({debug:true});
    </script>
@stop