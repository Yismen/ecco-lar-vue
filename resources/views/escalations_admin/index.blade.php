@extends('escalations_admin.home')

@section('views')
    <div class="row">
        <div class="col-sm-12">
            <h1 class=""><i class="fa fa-dashboard"></i> Dashboard</h1>
            <hr>

            {{-- <div class="col-sm-6">
                <h4 class="page-header">Users With Production This Month</h4>
                @if(isset($users) && count($users) > 0)
                    @foreach ($users as $user)
                        {{ $user }}
                        <div class="cols">
                            <div class="user-panel">
                                <div class="pull-left image">
                                  <img src="{{ $user->has('profile') && $user->profile && file_exists($user->profile->photo) ? '/'.$user->profile->photo : 'http://placehold.it/70x70' }}" class="img-circle" alt="User Image">
                                </div>
                                <div class="pull-left info">
                                  <p>
                                    @if ($user->has('profile') && $user->profile)
                                        <a href="/admin/profiles/{{ $user->profile->id}}">{{ $user->name }} <span class="badge badge-inverse">{{ $user->escalations_records_count }}</span></a>
                                    @else
                                        <span style="color: #000000;">{{ $user->name }} <span class="badge badge-inverse">{{ $user->escalations_records_count }}</span></span>
                                    @endif
                                    
                                  </p>
                                  <p style="color: #c0c0c0;">
                                    {{ $user->name }}
                                  </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info">
                        <strong>Sorry!</strong> None of the users have created records this month so far...
                    </div>
                @endif
            </div> --}}

            <div class="col-sm-6">
                <div class="box box-warning row">
                    <h4 class="page-header"><a href="/admin/escalations_admin/by_date">Records Processed Today By User</a></h4>
                    @if(isset($today) && count($today) > 0)
                        <div id="todayRecords" style="max-height: 250px;"></div>                    
                    @else
                        <div class="alert alert-warning">
                            <strong>Nothin Today!</strong> No Records have been entered today...
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <div class="box box-primary row">
                    <h4 class="page-header"><a href="/admin/escalations_admin/by_date">Records Processed This Month By User</a></h4>
                    @if(isset($thisMonth) && count($thisMonth) > 0)
                        <div id="thisMonthRcords" style="max-height: 250px;"></div>                    
                    @else
                        <div class="alert alert-primary">
                            <strong>Nothin This Month!</strong> No Records have been entered this month...
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-sm-12">
                <div class="box box-danger row">
                    <h4 class="page-header"><a href="/admin/escalations_admin/bbbs">Records Reported as BBB Today</a></h4>
                    @if(isset($bbbRecords) && count($bbbRecords) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date:</th>
                                        <th>User:</th>
                                        <th>Client:</th>
                                        <th>Tracking Number:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bbbRecords as $record)
                                        <tr>
                                            <td>{{ $record->insert_date }}</td>
                                            <td>{{ $record->user->name }}</td>
                                            <td>{{ $record->escal_client->name }}</td>
                                            <td>{{ $record->tracking }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>                
                    @else
                        <div class="alert alert-danger">
                            <strong>No BBBs yet my friend!</strong> No BBB Records so far...
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@stop
@section('dashboard_scripts')
    
    <script>

        (function($) {
            <?php if(isset($today) && count($today) > 0): ?>
                var data = <?php echo $today ?>;
                console.log(data);
                new Morris.Bar({
                  element: 'todayRecords',
                  data: data,
                  barColors: ['#f39c12'],
                  xkey: 'name',
                  ykeys: ['escalations_records_count'],
                  labels: ['Users'],
                  resize: true
                });
            <?php endif ?>

            <?php if(isset($thisMonth) && count($thisMonth) > 0): ?>
                var data = <?php echo $thisMonth ?>;
                console.log(data);
                new Morris.Bar({
                  element: 'thisMonthRcords',
                  data: data,
                  barColors: ['#3c8dbc'],
                  xkey: 'name',
                  ykeys: ['escalations_records_count'],
                  labels: ['Users'],
                  resize: true
                });
            <?php endif ?>

        })(jQuery)
    </script>
@stop