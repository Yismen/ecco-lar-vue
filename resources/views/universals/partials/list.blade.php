<div class="box box-primary no-padding">
    <div class="box-header with-border">
        <h3>
            Universal List
        </h3>
    </div>

    <div class="box-body no-padding">
        <table class="table table-condensed table-hover table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th class="col-xs-2">Universal Since</th>
                    <th class="col-xs-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($universal_list as $employee)
                <tr>
                    <td>
                        <a href="{{ route('admin.employees.show', $employee->id) }}" target="_employee">
                            {{ $employee->id }}
                        </a>
                    </td>
                    <td>{{ $employee->full_name }}</td>
                    <td>{{ $employee->universal->since->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('admin.universals.edit', $employee->universal->id) }}" class="btn btn-warning btn-xs">
                            <i class="fa fa-pencil"></i>
                            Edit
                        </a>
                        <delete-request-button
                            url="{{ route('admin.universals.destroy', $employee->universal->id) }}"
                            btn-class="btn btn-danger btn-xs"
                            btn-text=""
                            redirect-url="{{ route('admin.universals.index') }}"
                        ></delete-request-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="box-footer">
        {{ $universal_list->render() }}
    </div>
</div>
