<template>
    <div class="box box-primary">
        <div class="box-header with-border">
            <slot name="chart-header">Monthly Errors Count</slot>
        </div>
        <div class="box-body">
            <slot name="chart-body">
                <canvas id="monthlyErrors"></canvas>
            </slot>                    
        </div>
    </div> 
</template>

<script>
    export default {
        name: "BlackHawkCsErrorsMonthly",
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

                this.getThisMonthErrors()
                    .getLastMonthErrors()
                    .getTwoMonthsAgoErrors()
                    .render();
            }
        },
        methods: {
            render() {
                if (typeof this.chart == 'object') {
                    this.chart.destroy();                    
                }

                let ctx = document.getElementById('monthlyErrors').getContext('2d');
                let vm = this;

                this.chart = new Chart(ctx, {
                    type: 'bar',
                    
                    data: {
                        labels: vm.chart_data.map(vm => vm.field_name) ,
                        datasets: [
                            {
                                label: "Current Month QA Errors",
                                backgroundColor: 'rgba(211, 84, 0, 0.2)',
                                borderColor: 'rgba(211, 84, 0, 0.6)',
                                borderWidth: 2,
                                hoverBackgroundColor: 'rgba(211, 84, 0, 0.4)',
                                data: vm.chart_data.map(vm => vm.this_month)                                
                            },
                            {
                                label: "Previous Month QA Errors",
                                backgroundColor: 'rgba(142, 68, 173, 0.2)',
                                borderColor: 'rgba(142, 68, 173, 0.6)',
                                borderWidth: 2,
                                hoverBackgroundColor: 'rgba(142, 68, 173, 0.4)',
                                data: vm.chart_data.map(vm => vm.last_month)
                            },
                            {
                                label: "Two Months Ago QA Errors",
                                backgroundColor: 'rgba(41, 128, 185, 0.2)',
                                borderColor: 'rgba(41, 128, 185, 0.6)',
                                borderWidth: 2,
                                hoverBackgroundColor: 'rgba(41, 128, 185, 0.4)',
                                data: vm.chart_data.map(vm => vm.two_months_ago)
                            }
                        ]
                    },

                    // Configuration options go here
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
            getThisMonthErrors() {
                this.errors.this_month.forEach(function(this_month) {
                    let field_name = this_month.error_field
                    let last_month_exists = this.errors.last_month.find(last_month => last_month.error_field == field_name);
                    let two_months_ago_exists = this.errors.two_months_ago.find(two_months_ago => two_months_ago.error_field == field_name);
                    this.chart_data.push({
                        "field_name": field_name,
                        "this_month": this_month.count,
                        "last_month": last_month_exists ? last_month_exists.count : 0,
                        "two_months_ago": two_months_ago_exists ? two_months_ago_exists.count : 0,
                    });
                }, this);
                return this;
            },
            getLastMonthErrors() {
                this.errors.last_month.forEach(function(last_month) {
                    let field_name = last_month.error_field
                    let vm_exists = this.chart_data.find(vm => vm.field_name == field_name);
                    let two_months_ago_exists = this.errors.two_months_ago.find(two_months_ago => two_months_ago.error_field == field_name);
                    if (! vm_exists) {
                        this.chart_data.push({
                            "field_name": field_name,
                            "this_month": 0,
                            "last_month": last_month.count,
                            "two_months_ago": two_months_ago_exists ? two_months_ago_exists.count : 0,
                        });
                    }
                }, this);
                return this;
            },
            getTwoMonthsAgoErrors() {
                this.errors.two_months_ago.forEach(function(two_months_ago) {
                    let field_name = two_months_ago.error_field
                    let vm_exists = this.chart_data.find(vm => vm.field_name == field_name);
                    if (! vm_exists) {
                        this.chart_data.push({
                            "field_name": field_name,
                            "this_month": 0,
                            "last_month": 0,
                            "two_months_ago": two_months_ago.count,
                        });
                    }
                }, this);
                return this;
            }
        }
    }
</script>

<style lang="css" scoped>
    #monthlyErrors {
        min-height: 200px;
        max-height: 280px;
    }
</style>