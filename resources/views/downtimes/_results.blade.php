
@unless ($downtimes->count() > 0)
    <div class="col-sm-12">
        <div class="alert bg-yellow">
            <h3>We cant find any downtime for this date.</h3>
        </div>
    </div>
@else
    <div class="col-sm-12">
        @foreach ($downtimes as $d)

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user-2 no-padding">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-green">
                        <div class="widget-user-image">
                            <img class="img-circle" src="{{ asset($d->employee->photo) }}" alt="User Avatar">
                        </div>
                        <!-- /.widget-user-image -->
                        <h1 class="widget-user-username">{{ $d->employee->fullName }}</h1>
                        <h5 class="widget-user-desc"><i class="fa fa-user"></i> {{ $d->employee->positions->name }} </h5>
                    </div>

                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li class="list-group-item">
                                <span class="badge bg-green">{{ $d->from_time }}</span>
                                <i class="fa fa-clock-o"></i> From:
                            </li>
                            <li class="list-group-item">
                                <span class="badge bg-green">{{ $d->to_time }}</span>
                                <i class="fa fa-clock-o"></i> To:
                            </li>
                            <li class="list-group-item">
                                <span class="badge bg-aqua">{{ $d->break_time }}</span>
                                <i class="fa fa-clock-o"></i> Minutes Break:
                            </li>
                            <li class="list-group-item">
                                <span class="badge bg-blue">{{ $d->total_hours }}</span>
                                <i class="fa fa-clock-o"></i> Downtime Hours:
                            </li>
                            <li class="list-group-item">
                                <span class="badge bg-red">{{ $d->reason->reason }}</span>
                                <i class="fa fa-info-circle"></i> D. Reason:
                            </li>
                            <li class="list-group-item">
                                <span class="pull-right">
                                    <a href="{{ route('admin.downtimes.edit', $d->id) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </span>
                                <i class="fa fa-calendar"> </i> {{ $d->insert_date }}
                            </li>
                        </ul>
                        
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        @endforeach
    </div>
@endunless