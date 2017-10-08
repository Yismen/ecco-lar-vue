<div class="box box-info">
    <div class="box-body">
        <div class="col-sm-12">
            <h4><i class="fa fa-dashboard"></i> Imported Dates</h4>
            <div class="row">
                @foreach ($dates as $date)
                    <div class="col-sm-3">
                        <div class="alert alert-success">
                            <a href="{{ route('admin.hours.by-date', $date->date->format("Y-m-d")) }}">
                                <i class="fa fa-calendar"></i> 
                                {{ $date->date->format("M-d-Y") }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $dates->render() }}
        </div>
    </div>
</div>