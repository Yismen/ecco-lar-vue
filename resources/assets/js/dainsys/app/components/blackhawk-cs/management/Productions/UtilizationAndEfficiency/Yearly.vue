<template>
    <div>
        <div class="box box-success">
            <div class="box-header with-border">
                Yearly Utilization and Efficiency
            </div>
            <div class="box-body">
                <canvas id="utilizationAndEfficiencyYearlyChart"></canvas>
            </div>
        </div>
    </div>    
</template>

<script>
    export default {
        name: "BlackhawkCsManagementUtilizationAndEfficiency_Yearly",
        props: ['years'],
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

                let ctx = document.getElementById('utilizationAndEfficiencyYearlyChart').getContext('2d');
                let vm = this;
                this.chart = new Chart(ctx, {
                    type: 'line',
                    
                    data: {
                        labels: vm.labels,
                        datasets: [
                            {
                                label: "Yearly Utilization",
                                yAxisID: 'utilization',
                                borderColor: 'rgba(46, 204, 113,.5)',
                                backgroundColor: 'rgba(46, 204, 113,.5)',
                                data: vm.utilization,
                                fill: false
                            },
                            {
                                label: "Yearly Efficiency",
                                yAxisID: 'efficiency',
                                borderColor: 'rgba(46, 204, 113, 1.0)',
                                backgroundColor: 'rgba(46, 204, 113, 1.0)',
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
            years() {
                this.labels = [];
                this.utilization = [];

                this.years.forEach(function(elem) {
                    this.labels.push(elem.year);
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