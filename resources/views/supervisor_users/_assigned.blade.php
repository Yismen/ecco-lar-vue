
<div class="box box-info">
    <div class="box-header">
        <h5>List of Supervisors Assigned to Users </h5>
    </div>

    <div class="box-body">
        <table class="table table-condensed table-hover table-bordered">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>User Roles</th>
                    <th>Supervisor Group Assigned</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assigned as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>@include('supervisor_users._roles')</td>
                        @foreach ($user->supervisors as $supervisor)
                            @if ($loop->first)
                                <td>{{ $supervisor->name }}</td>
                                <td>
                                    <a href="{{ route('admin.supervisor_users.edit', $supervisor->pivot->id) }}" class="text-warning">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                </td>
                            @else
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>@include('supervisor_users._roles')</td>
                                    <td>{{ $supervisor->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.supervisor_users.edit', $supervisor->pivot->id) }}" class="text-warning">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                    </td>
                                </tr>  
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
