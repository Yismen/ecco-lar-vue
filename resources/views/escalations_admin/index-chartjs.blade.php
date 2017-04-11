@extends('escalations_admin.home')

@section('views')
    <div class="row">
        <div class="col-sm-12">
            <h1 class=""><i class="fa fa-dashboard"></i> Dashboard</h1>
            <hr>


            <div class="row">
                <div class="col-sm-12">
                    <div class="box box-info">
                        <h4 class="page-header">
                            <a href="/admin/escalations_admin/by_date"><i class="fa fa-star"></i> Pull Production</a>
                            <a href="/admin/escalations_admin/bbbs" class="pull-right"><i class="fa fa-envelope"></i> Pull BBBs</a>
                        </h4>
                        <div class="box-body" id="lastFiveDatesChartWrapper"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="box box-warning">
                        <h5 class="page-header"><a href="/admin/escalations_admin/by_date">Records Enteredy by Users Today</a></h5>
                        <div class="box-body" id="recordsByUserWrapper"></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="box box-warning">
                        <h5 class="page-header"><a href="/admin/escalations_admin/by_date">Records Enteredy by Clients Today</a></h5>
                        <div class="box-body" id="recordsByClientWrapper"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop
@section('dashboard_scripts')
    
    <script>

        (function($) {

            function init()
            {
                $.getJSON('/admin/escalations_admin', function(json, textStatus) {
                    if (textStatus == 'success') {
                        console.log(json)
                        var wrapper;

                        wrapper = $('#lastFiveDatesChartWrapper');
                        lastFiveDays(json.lastFiveDates, wrapper);
                        
                        wrapper = $('#recordsByUserWrapper');
                        todayRecordsByUser(json.todayRecordsByUser, wrapper);                        

                        wrapper = $('#recordsByClientWrapper');
                        recordsByClient(json.todayRecordsByClient, wrapper); 

                    }
                });
            }

            init();

            setInterval(init, 25000);


            function showEmptyResultsAlert(wrapper, message)
            {
                var alert = "";
                alert = alert + '<div class="alert alert-warning">'+ 
                    '<strong>No Records!</strong> '+message+' ...'+
                    '</div>';
                wrapper.html(alert);
            }

            function lastFiveDays(results, wrapper)
            {
                if (results.length == 0) {
                    var message = 'No Results for the last dates!';
                    showEmptyResultsAlert(wrapper, message);
                } else {
                    wrapper.html('<canvas id="lastFiveDatesChart" height="100"></canvas>');

                    var labels = [];
                    var recordsCreated = [];
                    var bbbRecords = [];
                    $.each(results, function(index, val) {
                        labels.push(val.insert_date);
                        recordsCreated.push(val.records);
                        bbbRecords.push(val.bbbRecords);
                    });

                    labels.reverse();
                    recordsCreated.reverse();
                    bbbRecords.reverse();

                    var ctx = "lastFiveDatesChart";
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: 'Records Entered Last Five Dates',
                                    yAxisID: 'records',
                                    data: recordsCreated,
                                    backgroundColor: "rgba(22, 160, 133, 0.5)",
                                },
                                {
                                    label: 'BBB Records by Date',
                                    yAxisID: 'bbb',
                                    data: bbbRecords,
                                    backgroundColor: "rgba(230, 126, 34, 0.5)",
                                }
                            ]
                            
                        },
                        options: {
                            responsive: true,
                            scales: {
                                yAxes: [
                                    {
                                        id: 'records',
                                        type: 'linear',
                                        position: 'left'
                                    },
                                    {
                                        id: 'bbb',
                                        type: 'linear',
                                        position: 'right'
                                    }
                                ]
                            }
                        }
                    });
                }
                    
            }

            function todayRecordsByUser(results, wrapper) 
            {
                if (results.length == 0) {
                    var message = 'No records created today so far';
                    showEmptyResultsAlert(wrapper, message);
                } else {
                    wrapper.html('<canvas id="recordsByUser" height="200"></canvas>');

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
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(26, 188, 156, 1)',
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
                    
            }

            function recordsByClient(results, wrapper)
            {
                if (results.length == 0) {
                    var message = 'No records created today so far';
                    showEmptyResultsAlert(wrapper, message);
                } else {
                    wrapper.html('<canvas id="recordsByClient" height="200"></canvas>');
                    
                    var labels = [];
                    var data = [];
                    $.each(results, function(index, val) {
                        labels.push(val.name);
                        data.push(val.escal_records_count);
                    });
                    
                    var ctx = "recordsByClient";
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Records By Client',
                                data: data,
                                backgroundColor: [
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(26, 188, 156, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(153, 102, 255, 1)',
                                ],
                            }]
                            
                        },
                        options: {
                            responsive: true
                        }
                    });

                }
            }
        })(jQuery)
    </script>
@stop