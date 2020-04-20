@if (count($birthdays['today']) > 0)
    <p>The following employees have birthday today!</p>
    @foreach ($birthdays['today'] as $employee)
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-green">
                <a href="{{ route('admin.employees.show', $employee->id) }}" target="_employee" title="Details">
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ $employee->photo }}" alt="User Avatar">
                    </div>
                </a>
                <!-- /.widget-user-image -->
                <h4 class="widget-user-username">{{ $employee->full_name }}</h4>
                <h5 class="widget-user-desc">{{ optional($employee->position)->name_and_department }}</h5>
            </div>
        </div>
    @endforeach
@else
    <div class="alert alert-default">
        <strong>No Birthdays today!</strong> None of your peers have birthdays today...
    </div>
@endif
