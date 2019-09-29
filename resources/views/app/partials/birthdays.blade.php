<div class="row">
        @if (count($birthdays) > 0)
            <div class="col-sm-12">
                <h4 style="text-transform: uppercase;">The following employees have birthday today!</h4>
            </div>
            @foreach ($birthdays as $employee)
                <div class="col-md-6">
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-green">
                            <div class="widget-user-image">
                                <img class="img-circle" src="{{ $employee->photo }}" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h4 class="widget-user-username">{{ $employee->full_name }}</h4>
                            <h5 class="widget-user-desc">
                                {{ optional($employee->site)->name }},
                                {{ optional($employee->project)->name }},
                                {{ optional($employee->position)->name_and_department }}
                            </h5>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-sm-12">
                <div class="alert alert-default">
                    <strong>No Birthdays today!</strong> None of your peers have birthdays today...
                </div>
            </div>
        @endif
</div>
