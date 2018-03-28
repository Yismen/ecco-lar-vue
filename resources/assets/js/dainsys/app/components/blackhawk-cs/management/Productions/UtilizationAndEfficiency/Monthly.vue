<template>
    <div>
        <div class="box box-primary">
            <div class="box-header with-border">
                Monthly Utilization and Efficiency
            </div>
            <div class="box-body">
                <canvas id="utilizationAndEfficiencyMonthlyChart"></canvas>
            </div>
        </div>
    </div>    
</template>

<script>
    export default {
        name: "BlackhawkCsManagementUtilizationAndEfficiency_Monthly",
        props: ['months'],
        data() {
            return {
                chart: '',
                labels: [],
                utilization: [],
                efficiency: [],
            }
        },
        methods: {
            getUtilization(data) {
                let utilization = data.time_online > 0 ? 
                    ((data.email_sessions * 6 / 60) + data.time_in_chats) / data.time_online * 100 :
                    0;
                return utilization.toFixed(2);
            },

            getEfficiency(data) {
                let efficiency = data.time_logged_in > 0 ? 
                    data.time_online / data.time_logged_in * 100 :
                    0;
                return efficiency.toFixed(2);
            },
            render() {
                if (typeof this.chart == 'object') {
                    this.chart.destroy();                    
                }
                this.labels.reverse()
                this.utilization.reverse()
                this.efficiency.reverse()

                let ctx = document.getElementById('utilizationAndEfficiencyMonthlyChart').getContext('2d');
                let vm = this;
                this.chart = new Chart(ctx, {
                    type: 'line',
                    
                    data: {
                        labels: vm.labels,
                        datasets: [
                            {
                                label: "Monthly Utilization",
                                yAxisID: 'utilization',
                                borderColor: 'rgba(41, 128, 185,.5)',
                                backgroundColor: 'rgba(41, 128, 185,.5)',
                                data: vm.utilization,
                                fill: false
                            },
                            {
                                label: "Monthly Efficiency",
                                yAxisID: 'efficiency',
                                borderColor: 'rgba(41, 128, 185, 1.0)',
                                backgroundColor: 'rgba(41, 128, 185, 1.0)',
                                data: vm.efficiency,
                                fill: false
                            }
                        ]
                    },

                    // Configuration options go here
                    options: {
                        legend: {
                            display: false
                        },
                        tooltips: {
                            intersect: false,
                             mode: 'index'
                        },
                        scales: {
                            yAxes: [
                                {
                                    position: 'left',
                                    id: 'utilization',
                                    stacked: false
                                },                                
                                {
                                    position: 'right',
                                    id: 'efficiency',
                                    stacked: true,
                                    gridLines: {
                                        display: false
                                    }  
                                }
                            ],                            
                            xAxes: [{
                                gridLines: {
                                    display: false
                                }
                            }]
                        }
                    }
                });
            }
        },
        watch: {
            months() {
                this.labels = [];
                this.utilization = [];

                this.months.forEach(function(elem) {
                    this.labels.push(elem.year + "-" + elem.month.substr(0, 3));
                    this.utilization.push(
                        this.getUtilization(elem)
                    );
                    this.efficiency.push(
                        this.getEfficiency(elem)
                    )
                }, this);

                return this.render();
            }
        }
    }
</script>

<style lang="css" scoped>

</style>