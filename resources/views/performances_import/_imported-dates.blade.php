<div class="box box-info">
    <div class="box-body">
        <div class="box-header">
            <h4>Imported Dates</h4>
        </div>

        <div class="box-body">
            <table class="table table-condensed table-bordered">
                <thead>
                    <tr>
                        <th>Performance Date</th>
                        <th>File Name</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($performances as $performance)
                        <tr>
                            <td>
                                <a href="/admin/performances_import/by_date/{{ $performance->date }}" title="SHOW ONLY DATA FOR THIS DATE">{{ $performance->date }}</a>
                            </td>
                            <td>{{ $performance->file_name }}</td>
                            <td>{{ $performance->created_at->diffForHumans() }}</td>
                            <td>
                                <delete-request-button
                                    url="/admin/performances_import/mass_delete?date={{$performance->date}}&file_name={{$performance->file_name}}"
                                    btn-class="btn btn-link no-padding text-red"
                                    redirect-url="{{ route('admin.performances_import.index') }}"
                                ></delete-request-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="box-footer">
            {{ $performances->links() }}
        </div>
    </div>
</div>
