<div class="col-sm-6">
    <div class="box box-danger">
        <div class="box-header">
            <h4>
                {{ $supervisor->name }}
                <span class="badge">{{ $supervisor->employees->count() }}</span>
                <a href="{{ route('admin.supervisors.edit', $supervisor->id) }}" class="pull-right text-warning">
                    <i class="fa fa-edit"></i>
                </a>
            </h4>
        </div>
        <table class="table table-condensed table-bordered">
            <tbody>
                @foreach ($supervisor->employees as $employee)
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="{{ $employee->id }}" name="employee[]">
                                    {{ $employee->full_name }}
                                </label>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

