
@unless (isset($employees))
    <div class="alert alert-info">
        <strong>None!</strong> Nothing found, please try with different criterias....
    </div>
@else
    <div class="table-responsive">
        <table class="table table-striped table-condensed table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Source</th>
                    <th>Client</th>
                    <th>Prod. Hours</th>
                    <th>Downtime</th>
                    <th>Total Hours</th>
                    <th>Production</th>
                    <th>TP</th>
                    <th>
                        <a href="{{ route('admin.productions.create') }}"><i class="fa fa-plus"></i></a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    @foreach($employee->productions as $p)
                        <tr>
                            <td>{{ $p->insert_date }}</td>
                            <td>{{ $p->employee_id }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->source->name }}</td>
                            <td>{{ $p->client->name }}</td>
                            <td>{{ $p->production_hours }}</td>
                            <td>{{ $p->downtime }}</td>
                            <td>{{ $p->downtime + $p->production_hours}}</td>
                            <td>{{ $p->production }}</td>
                            <td>{{ number_format($p->production / $p->production_hours, 2) }}</td>
                            <td>
                                <a href="{{ route('admin.production-hours.edit',$p->id) }}"><i class="fa fa-pencil"></i></a>    
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>       

    {{ $employees }}
@endunless