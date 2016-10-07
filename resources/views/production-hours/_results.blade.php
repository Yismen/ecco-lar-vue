@if (!isset($employees) || $employees->count() == 0)
    <div class="alert alert-info">
        <strong>None!</strong> Nothing found, please try with different criterias. ...
    </div>
@else
    <div class="col-sm-12">
        
        @foreach ($employees as $employee)

            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>Name:</th>
                        <th>Total Production:</th>
                        <th>Total Production Hours:</th>
                        <th>Total Downtime Hours:</th>
                        <th>Total Hours:</th>
                        <th>Total TP:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>{{ $employee->first_name }} {{ $employee->last_name }}</strong></td>
                        <td>{{ $employee->productions->sum('production') }}</td>
                        <td>{{ $employee->productions->sum('production_hours') }}</td>
                        <td>{{ $employee->productions->sum('downtime') }}</td>
                        <td>{{ $employee->productions->sum('production_hours') + $employee->productions->sum('downtime') }}</td>
                        <td>{{ number_format($employee->productions->sum('production') / $employee->productions->sum('production_hours'), 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="col-sm-12">
                <div class="row">
                    @foreach ($employee->productions as $production)
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h4>{{ $production->source->name }}, {{ $production->client->name }}</h4>

                                <table class="table table-condensed">
                                    <tbody>
                                        <tr>
                                            <th align="right">Production: </th>
                                            <td>{{ $production->production }}</td>
                                        </tr>
                                        <tr>
                                            <th align="right">Production Hours:</th>
                                            <td>{{ $production->production_hours }}</td>
                                        </tr>
                                        <tr>
                                            <th align="right">Downtime Hours:</th>
                                            <td>{{ $production->downtime }}</td>
                                        </tr>
                                        <tr>
                                            <th align="right">Total Hours:</th>
                                            <td>{{ $production->production_hours + $production->downtime }}</td>
                                        </tr>
                                        <tr>
                                            <th align="right">Productivity:</th>
                                            <td>{{ number_format($production->production  / $production->production_hours, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            {{-- <div class="icon">
                                <i class="fa fa-shopping-cart"></i>
                                <a href="">asdf</a>
                            </div> --}}
                            <a href="{{ route('admin.production-hours.edit', $production->id) }}" class="small-box-footer">
                                Edit <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
               </div>
            </div>
        @endforeach
        <hr>    
    </div>
    {{ $employees }}
@endif