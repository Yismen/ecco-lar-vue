@foreach ($birthdays['today']  as $employee)
    {{-- <div class="alert alert-success">
        <div class="row">
            <div class="col-sm-12"><h4>{{ $employee->full_name }} <i class="fa fa-birthday-cake pull-right"></i></h4></div>
            <div class="col-sm-3">
                <img src="{{ $employee->photo }}" class="img-responsive img-circle" alt="Image">
            </div>
            <div class="col-sm-9">
                <div class="text-center">
                    <h5>From {{ $employee->position->department->name }}, {{ $employee->position->name }}</h5>
                    <p>Turning {{ $employee->date_of_birth->age }} years old today.</p>
                </div>
            </div>
        </div>
    </div>
 --}}
    <div class="info-box bg-aqua">
        <span class="info-box-icon">
            <img src="{{ $employee->photo }}" class="img-responsive img-circle offline" alt="Image">
        </span>
        <div class="info-box-content">
            <div class="info-box-number">
                <i class="fa fa-birthday-cake"></i>
                 {{ $employee->full_name }}
            </div>
            <div class="info-box-text">
                From {{ $employee->position->department->name }}, {{ $employee->position->name }}, <br>
                Turning {{ $employee->date_of_birth->age }} years old today.
            </div>
        </div>
    </div>
@endforeach
