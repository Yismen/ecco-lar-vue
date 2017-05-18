@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Date Calculator', 'page_description'=>'Calculate dates diff'])

@section('content')
    <div class="col-sm-10 col-sm-offset-1">
        <div class="box box-primary pad big-box">
            <div class="row">                        

                @if( $errors->any() )
                    <div class="col-sm-12">
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                {{-- /. Errors --}}

                <div class="col-sm-12" id="errors"></div>

                <div class="col-sm-12">
                    <div class="col-sm-6">
                        @include('date_calc._from_today_form')
                    </div>
                    <div class="col-sm-6">
                        @include('date_calc._range_form')
                    </div>
                </div>
                <div class="row" id="results">
                    @if (isset($result))
                        @include('date_calc._results', ['result'=>$result])
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('form').myFormSubmit();
    </script>
@stop