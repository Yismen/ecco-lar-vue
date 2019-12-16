
<div class="box box-warning">
    <div class="box-header">
        <h5>List of Users not assigned to any supervisor </h5>
    </div>

    <div class="box-body">
        <table class="table table-condensed table-hover table-bordered">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>User Roles</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($free_users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>@include('supervisor_users._roles')</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    