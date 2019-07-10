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
            @foreach ($supervisor->employees->chunk(3) as $chunk)
                <div class="row">
                    @foreach ($chunk as $employee)
                        <div class="col-xs-4">
                             <employee-check-box :employee="{{ $employee }}"
                                >,
                                {{ optional($employee->position)->name }}
                            </employee-check-box>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endif

