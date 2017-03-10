@extends('escalations_admin.home')

@section('views')
    
    <div class="row">
        <div class="col-sm-12">
            {!! Form::open(['url'=>['/admin/escalations_admin/by_date',], 'method'=>'POST', 'class'=>'form-inline', 'role'=>'form', 'autocomplete'=>"off"]) !!}        
                <legend>Search by Date</legend>
            
                <!-- Production Date -->
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <b>Detailed</b>
                                <input type="checkbox" value="1" name="detailed">
                            </label>
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
                        {!! Form::label('date', 'Production Date:', ['class'=>'']) !!}
                            <div class="input-group">
                                {!! Form::input('date', 'date', null, ['class'=>'form-control', 'placeholder'=>'Production Date']) !!}   
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                         Search
                                    </button>
                                </span>     
                            </div>
                            {!! $errors->first('date', '<span class="text-danger">:message</span>') !!}
                    </div>
                </div>
                <!-- /. Production Date --> 
            {!! Form::close() !!}

            @if (isset($clients) && isset($users))
                <hr>
                <div class="col-sm-12">
                    <div class="page-header">Results for Date [{{ Request::old('date') }}] </div>
                </div>

                <div class="col-sm-6">

                    <div class="box box-success">
                        <h3>Count By Clients</h3>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th>Client:</th>
                                        <th>Count:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->escal_records_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th>Total:</th>
                                    <th>{{ $clients->sum('escal_records_count') }}</th>
                                </tfoot>
                            </table>
                        </div>

                        {{-- <canvas id="clientsChart" height="100%" width="60px"></canvas> --}}
                    </div>

                </div>

                <div class="col-sm-6">
                
                    <div class="box box-warning">
                        <h3>Count By Users</h3>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-condensed table-bordered">
                                <thead>
                                    <tr>
                                        <th>Client:</th>
                                        <th>Count:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->escalations_records_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th>Total:</th>
                                    <th>{{ $users->sum('escalations_records_count') }}</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    
                </div>
                
                @if (isset($detailed) && $detailed->count() > 0)
                    <div class="col-sm-12">
                        <div class="box box-danger">
                            <div class="table-responsive">
                                <h4>Detailed list of tracking numbers</h4>
                                <table class="table table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Insert Date:</th>
                                            <th>Client: </th>
                                            <th>Created By: </th>
                                            <th>Tracking Number: </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailed as $record)
                                            <tr>
                                                <td>{{ $record->insert_date }}</td>
                                                <td>{{ $record->client->name }}</td>
                                                <td>{{ $record->user->name }}</td>
                                                <td>{{ $record->tracking }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
                   

                {{-- /Clients and Users --}}
                {{-- {{ $ }} --}}
                {{-- /.Clients and Users --}}

            @endif
        </div>
    </div>
@stop