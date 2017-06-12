@foreach ($birthdays['today']  as $employee)
    <div class="alert alert-success">
        <div class="row">
            <div class="col-sm-12"><h4>{{ $employee->full_name }} <i class="fa fa-birthday-cake pull-right"></i></h4></div>
            <div class="col-sm-3">
                <img src="{{ $employee->photo or 'ZXcXC' }}" class="img-responsive img-circle" alt="Image">
            </div>
            <div class="col-sm-9">
                <div class="text-center">
                    <h5>From {{ $employee->position->department->department }}, {{ $employee->position->name }}</h5>
                    <p>Turning {{ $employee->date_of_birth->age }} years old today.</p>
                </div>
            </div>
        </div>
    </div>
@endforeach
    