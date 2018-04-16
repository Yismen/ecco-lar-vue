<template>
    <div>
        <div class="box box-primary">
            <div class="box-header with-border">
                Monthly Utilization and Efficiency
            </div>
            <div class="box-body">
                <canvas id="ussageMonthlyChart"></canvas>
            </div>
        </div>
    </div>    
</template>

<script>
    import Ussage from './Ussage' 
    export default {
        name: "BlackhawkCsManagementUssage_Monthly",
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
            render() {
                if (typeof this.chart == 'object') {
                    this.chart.destroy();                    
                }
                this.labels.reverse()
                this.utilization.reverse()
                this.efficiency.reverse()

                let ctx = document.getElementById('ussageMonthlyChart').getContext('2d');
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
                            intersect: true,
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
                        Ussage.utilization(elem.time_online, elem.time_in_chats, elem.email_sessions)
                    );
                    this.efficiency.push(
                        Ussage.efficiency(elem.time_logged_in, elem.time_online)
                    )
                }, this);

                return this.render();
            }
        }
    }
</script>

<style lang="css" scoped>
    #ussageMonthlyChart {
        min-height: 200px;
        max-height: 280px;
    }
</style>