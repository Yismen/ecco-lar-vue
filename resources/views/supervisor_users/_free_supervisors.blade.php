
<div class="box box-warning">
    <div class="box-header">
        <h5>List of Supervisors not assigned to any user </h5>
    </div>

    <div class="box-body">
        <table class="table table-condensed table-hover table-bordered">
            <thead>
                <tr>
                    <th>Supervisor Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($free_supervisors as $supervisor)
                    <tr>
                        <td>{{ $supervisor->name }}</td>
                        <td>{{ $supervisor->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    