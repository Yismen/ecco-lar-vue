@if ($supervisor->employees->count() > 0 || $supervisor->active)
    <div class="box box-warning">
        <div class="box-header">
            <h4>
                <a href="{{ route('admin.supervisors.show', $supervisor->id) }}">{{ $supervisor->name }}</a>
                <span class="badge bg-yellow">{{ $supervisor->employees->count() }}</span>
                <a href="{{ route('admin.supervisors.edit', $supervisor->id) }}" class="pull-right text-warning">
                    <i class="fa fa-edit"></i>
                </a>
            </h4>
        </div>

        <div class="box-body">
            <table class="table table-condensed table-hover">

                <tbody>
                    @foreach ($supervisor->employees as $employee)
                        <tr class="col-md-4 col-sm-6">
                            <td>
                                <employee-check-box :employee="{{ $employee }}"
                                >,
                                    {{ optional($employee->position)->name }}
                                </employee-check-box>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

