@extends('escalations_admin.home')

@section('views')
    
    <div class="row">
        <div class="col-sm-12">

            {!! Form::open(['url'=>['/admin/escalations_admin/search'], 'method'=>'GET', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}        
                <legend>Search Records</legend>

                <!-- Tracking Number -->
                <div class="col-sm-12">
                    <div class="form-group {{ $errors->has('tracking') ? 'has-error' : null }}">
                        {!! Form::label('tracking', 'Tracking Number:', ['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <div class="input-group">
                                {!! Form::input('text', 'tracking', null, ['class'=>'form-control', 'placeholder'=>'Tracking Number']) !!}
                                <span  class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fa fa-search"> Search </i></button>
                                </span >
                            </div>
                            {!! $errors->first('tracking', '<span class="text-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>
                <!-- /. Tracking Number -->
            
                
            
            {!! Form::close() !!}

            @if (isset($records))
                <hr>
                <div class="col-sm-12">
                    <div class="page-header">Results for Tracking [{{ Request::old('tracking') }}] </div>
                </div>

                @unless ($records->count() > 0 )
                    Not found
                @else

                    <div class="col-sm-12">
                        <div class="box box-success">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Client:</th>
                                            <th>Count:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($records as $record)
                                            <tr>
                                                <td>{{ $record->tracking }}</td>
                                                <td>{{ $record->user->name }}</td>
                                                <td>{{ $record->client->name }}</td>
                                                <td>{{ $record->created_at->format('M/d/Y') }}</td>
                                                

                                                {{-- <td>{{ $record->escal_records_count }}</td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{ $records }}
                            </div>

                            {{-- <canvas id="clientsChart" height="100%" width="60px"></canvas> --}}
                        </div>
                    </div>

                @endunless


            @endif
        </div>
    </div>
@stop