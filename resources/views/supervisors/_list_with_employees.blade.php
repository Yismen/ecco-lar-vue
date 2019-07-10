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

        <?php $count = $supervisor->employees->count() == 0 ? 0 : ceil($supervisor->employees->count() / 3) ?>

        <div class="box-body">
            <div class="row">
                @foreach ($supervisor->employees->chunk($count) as $chunk)
                    <div class="col-sm-4">
                        @foreach ($chunk as $employee)
                             <employee-check-box :employee="{{ $employee }}"
                                >,
                                {{ optional($employee->position)->name }}
                            </employee-check-box>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

