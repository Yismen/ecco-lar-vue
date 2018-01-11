<div class="box box-info">
    <div class="box-header">
        <i class="fa fa-dashboard"></i> 
        Payrolls
        <a href="{{ route('admin.payrol.generate') }}" class="pull-right">
            <i class="fa fa-database"></i> 
            Generate
        </a>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>Payroll ID</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Payment Date</th>
                        {{-- <th>Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dates as $date)
                        <tr>
                            <td>
                                <a href="{{ route('admin.payrolls.by_payroll_id', $date->payroll_id) }}">{{ $date->payroll_id }}</a>
                            </td>
                            <td>{{ $date->from_date }}</td>
                            <td>{{ $date->to_date }}</td>
                            <td>{{ $date->payment_date }}</td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $dates->render() }}
    </div>

</div>