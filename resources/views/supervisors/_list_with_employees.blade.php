@if ($supervisor->employees->count() > 0)
    <div class="box box-warning">
        <div class="box-header">
            <h4>
                {{ $supervisor->name }}
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
                        <tr is="employee-row" :employee="{{ $employee }}" class="col-lg-3 col-md-4 col-sm-6">
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

