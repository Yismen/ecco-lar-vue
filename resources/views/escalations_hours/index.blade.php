@extends('escalations_admin.home')

@section('views')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="box box-primary">
                        <div class="box-header "><h2>Escalations Hours</h2></div>

                        @unless ($hours->count() > 0)
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>No Records!</strong> Alert body ...
                            </div>
                        @else
                            <div class="row">
                                @foreach ($hours as $hour)
                                    <div class="col-md-2 col-sm-3 col-xs-4">
                                        <div class="alert alert-info">
                                            <a href="{{ route('admin.escalations_hours.byDate', ['date'=>$hour->date->format('Y-m-d') ]) }}">
                                                <i class="fa fa-calendar"></i> 
                                                {{ $hour->date->format('M/d/Y') }}
                                            </a>
                                        </div>
                                    </div>
                                @endforeach 
                            </div>   
                            <div class="col-sm-12">   
                                {{ $hours->render() }}
                            </div>                    
                        @endunless

                         {{--    
                        <div class="box-body no-padding">
                            {!! Form::open(['route'=>['admin.escalations_hours.search'], 'method'=>'POST', 'class'=>'', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!}
                                @include('escalations_hours._form_search')
                            {!! Form::close() !!}
                        </div>  
                         --}}
                    </div>
            
                </div>

                    @include('escalations_hours._search_results')
            </div>
                
                
        </div>

        
    </div>
@endsection
@section('scripts')

@stop