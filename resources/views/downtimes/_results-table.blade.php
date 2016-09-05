
@unless ($downtimes->count() > 0)
    <div class="col-sm-12">
        <div class="alert bg-yellow">
            <h3>We cant find any downtime for this date.</h3>
        </div>
    </div>
@else
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-condensed table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name:</th>
                        <th>Position:</th>
                        <th>From:</th>
                        <th>To:</th>
                        <th>break:</th>
                        <th>Total:</th>
                        <th>Reason:</th>
                        <th>Add:</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($downtimes as $downtime)
                        <tr>
                            <td>{{ $downtime->employee->fullName }}</td>
                            <td>{{ $downtime->employee->positions->name }}</td>
                            <td>{{ $downtime->from_time }}</td>
                            <td>{{ $downtime->to_time }}</td>
                            <td>{{ $downtime->break_time }}</td>
                            <td>{{ $downtime->total_hours }}</td>
                            <td>{{ $downtime->reason->reason }}</td>
                            <td>
                                 <a href="{{ route('admin.downtimes.edit', $downtime->id) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endunless