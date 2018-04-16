<template>
    <div>
        <div class="box box-warning">
            <div class="box-header with-border">
                Weekly Errors Count
            </div>
            <div class="box-body">
                <canvas id="weeklyErrorsChart"></canvas>
            </div>
        </div>
    </div>    
</template>

<script>
    export default {
        name: "BlackHawkCsErrorsWeekly",
         props: ['errors'],
        data() {
            return {
                chart: '',
                chart_data: [],
            }
        },
        watch: {
            errors() {
                this.chart_data = [];

                this.getThisWeekErrors()
                    .getLastWeekErrors()
                    .getTwoWeeksAgoErrors()
                    .render();
            }
        },
        methods: {
            render() {
                if (typeof this.chart == 'object') {
                    this.chart.destroy();                    
                }

                let ctx = document.getElementById('weeklyErrorsChart').getContext('2d');
                let vm = this;

                this.chart = new Chart(ctx, {
                    type: 'bar',
                    
                    data: {
                        labels: vm.chart_data.map(vm => vm.field_name) ,
                        datasets: [
                            {
                                label: "Current Week QA Errors",
                                backgroundColor: 'rgba(211, 84, 0, 0.2)',
                                borderColor: 'rgba(211, 84, 0, 0.6)',
                                borderWidth: 2,
                                hoverBackgroundColor: 'rgba(211, 84, 0, 0.4)',
                                data: vm.chart_data.map(vm => vm.this_week)                                
                            },
                            {
                                label: "Previous Week QA Errors",
                                backgroundColor: 'rgba(142, 68, 173, 0.2)',
                                borderColor: 'rgba(142, 68, 173, 0.6)',
                                borderWidth: 2,
                                hoverBackgroundColor: 'rgba(142, 68, 173, 0.4)',
                                data: vm.chart_data.map(vm => vm.last_week)
                            },
                            {
                                label: "Two Weeks Ago QA Errors",
                                backgroundColor: 'rgba(41, 128, 185, 0.2)',
                                borderColor: 'rgba(41, 128, 185, 0.6)',
                                borderWidth: 2,
                                hoverBackgroundColor: 'rgba(41, 128, 185, 0.4)',
                                data: vm.chart_data.map(vm => vm.two_weeks_ago)
                            }
                        ]
                    },
                    options: {
                        ticks: {
                            callback: function(value) {
                                return value.substr(0, 10);//truncate
                            },
                        },
                        legend: {
                            display: false
                        },
                        tooltips: {
                            intersect: true,
                            mode: 'index'
                        },
                        scales: {                           
                            xAxes: [{
                                gridLines: {
                                    offsetGridLines: true
                                }
                            }]
                        }
                    }
                });
            },
            getThisWeekErrors() {
                this.errors.this_week.forEach(function(this_week) {
                    let field_name = this_week.error_field
                    let last_week_exists = this.errors.last_week.find(last_week => last_week.error_field == field_name);
                    let two_weeks_ago_exists = this.errors.two_weeks_ago.find(two_weeks_ago => two_weeks_ago.error_field == field_name);
                    this.chart_data.push({
                        "field_name": field_name,
                        "this_week": this_week.count,
                        "last_week": last_week_exists ? last_week_exists.count : 0,
                        "two_weeks_ago": two_weeks_ago_exists ? two_weeks_ago_exists.count : 0,
                    });
                }, this);
                return this;
            },
            getLastWeekErrors() {
                this.errors.last_week.forEach(function(last_week) {
                    let field_name = last_week.error_field
                    let vm_exists = this.chart_data.find(vm => vm.field_name == field_name);
                    let two_weeks_ago_exists = this.errors.two_weeks_ago.find(two_weeks_ago => two_weeks_ago.error_field == field_name);
                    if (! vm_exists) {
                        this.chart_data.push({
                            "field_name": field_name,
                            "this_week": 0,
                            "last_week": last_week.count,
                            "two_weeks_ago": two_weeks_ago_exists ? two_weeks_ago_exists.count : 0,
                        });
                    }
                }, this);
                return this;
            },
            getTwoWeeksAgoErrors() {
                this.errors.two_weeks_ago.forEach(function(two_weeks_ago) {
                    let field_name = two_weeks_ago.error_field
                    let vm_exists = this.chart_data.find(vm => vm.field_name == field_name);
                    if (! vm_exists) {
                        this.chart_data.push({
                            "field_name": field_name,
                            "this_week": 0,
                            "last_week": 0,
                            "two_weeks_ago": two_weeks_ago.count,
                        });
                    }
                }, this);
                return this;
            }
        }
    }
</script>

<style lang="css" scoped>
    #weeklyErrorsChart {
        min-height: 200px;
        max-height: 280px;
    }
</style>