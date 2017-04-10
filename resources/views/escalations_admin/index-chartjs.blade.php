@extends('escalations_admin.home')

@section('views')
    <div class="row">
        <div class="col-sm-12">
            <h1 class=""><i class="fa fa-dashboard"></i> Dashboard</h1>
            <hr>


            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-info">
                        <canvas id="lastFiveDatesChart" height="100px"></canvas>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="box box-warning">
                        <h5 class="page-header"><a href="/admin/escalations_admin/by_date">Records Enteredy by Users Today</a></h5>
                        <div class="box-body">
                            <canvas id="recordsByUser"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="box box-warning">
                        <h5 class="page-header"><a href="/admin/escalations_admin/by_date">Records Enteredy by Clients Today</a></h5>
                        <div class="box-body">
                            <canvas id="recordsByClient"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Here we go... --}}

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
                        <div class="alert alert-info">
                            <strong>Nothin This Month!</strong> No Records have been entered this month...
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <div class="box box-info row">
                    <h4 class="page-header"><a href="/admin/escalations_admin/by_date">Records Processed Today By Client</a></h4>
                    <div id="byClients" style="max-height: 250px;"></div>    
                </div>
            </div>

            <div class="col-sm-6">
                <div class="box box-danger row">
                    <h4 class="page-header"><a href="/admin/escalations_admin/bbbs">Records Reported as BBB Today</a></h4>
                    @if(isset($bbbRecords) && count($bbbRecords) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>User:</th>
                                        <th>Client:</th>
                                        <th>Tracking Number:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bbbRecords as $record)
                                        <tr>
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

            $.getJSON('/admin/escalations_admin', function(json, textStatus) {
                console.log(json)
                if (textStatus == 'success') {

                    if (json.todayRecordsByUser.length > 0) {
                        todayRecordsByUser(json.todayRecordsByUser);
                    }
                    if (json.lastFiveDates.length > 0) {
                        lastFiveDays(json.lastFiveDates);
                    }
                    if (json.todayRecordsByClient.length > 0) {
                        recordsByClient(json.todayRecordsByClient);
                    }

                }
            });

            function todayRecordsByUser(results) {
                
                var labels = [];
                var data = [];
                $.each(results, function(index, val) {
                    labels.push(val.name);
                    data.push(val.escalations_records_count);
                });
                var ctx = "recordsByUser";
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Records By Users',
                            data: data,
                            backgroundColor: [
                                'rgba(26, 188, 156, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                            ],
                        }]
                        
                    },
                    options: {
                        responsive: true
                    }
                });
            }

            function lastFiveDays(results)
            {
                var labels = [];
                var data = [];
                $.each(results, function(index, val) {
                    labels.push(val.insert_date);
                    data.push(val.records);
                });

                labels.reverse();
                data.reverse();

                var ctx = "lastFiveDatesChart";
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Records Entered Last Five Dates',
                            data: data,
                            backgroundColor: "rgba(75,192,192,0.5)",
                        }]
                        
                    },
                    options: {
                        responsive: true
                    },
                    scales: {
                        xAxes: [{
                            type: 'linear',
                            position: 'bottom'
                        }]
                    }
                });
            }

            function recordsByClient(records)
            {
                var data = [];
                $.each(records, function(index, val) {
                    data.push({label: val.name, value: val.escal_records_count});
                });

                new Morris.Donut({
                  element: 'byClients',
                  data: data,
                  colors: ['#1abc9c', '#3498db', '#9b59b6', '#f1c40f', '#e67e22'],
                  resize: true
                });
            }

            // <?php if(isset($today) && count($today) > 0): ?>
            //     var data = [];
            //     $.each(<?php echo $today ?>, function(index, val) {
            //         data.push({label: val.name, value: val.escalations_records_count});
            //     });

            //     new Morris.Donut({
            //       element: 'todayRecords',
            //       data: data,
            //       colors: ['#f39c12', '#e74c3c', '#1abc9c', '#f1c40f', '#e67e22'],
            //       resize: true
            //     });
            // <?php endif ?>

            <?php if(isset($thisMonth) && count($thisMonth) > 0): ?>
                var data = <?php echo $thisMonth ?>;

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

            // <?php if(isset($byClients) && count($byClients) > 0): ?>
            //     var data = [];
            //     $.each(<?php echo $byClients ?>, function(index, val) {
            //         data.push({label: val.name, value: val.escal_records_count});
            //     });

            //     new Morris.Donut({
            //       element: 'byClients',
            //       data: data,
            //       colors: ['#1abc9c', '#3498db', '#9b59b6', '#f1c40f', '#e67e22'],
            //       resize: true
            //     });
            // <?php endif ?>

        })(jQuery)
    </script>
@stop