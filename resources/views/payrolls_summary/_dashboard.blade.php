<div class="box box-info">
    <div class="box-header">
        <i class="fa fa-dashboard"></i> 
        Payrolls
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
                                <a href="{{ route('admin.payrolls_summary.by_payroll_id', $date->payroll_id) }}">{{ $date->payroll_id }}</a>
                            </td>
                            <td>{{ $date->from_date }}</td>
                            <td>{{ $date->to_date }}</td>
                            <td>{{ $date->payment_date }}</td>
                           {{--  <td>
                                <form action="{{ url('/admin/payroll_summary/remove_by_payroll_id', $date->payroll_id) }}" method="POST" style="display: inline-block;">
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}
                                
                                    <button type="submit" id="delete-payroll_summary" class="btn btn-danger btn-sm"  name="deleteBtn">
                                        <i class="fa fa-btn fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td> --}}
                            {{-- <td>{{ dump($date) }}</td> --}}
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $dates->render() }}
    </div>

</div>