<template>
    <div>
        <div class="box box-success">
            <div class="box-header with-border">
                Daily TP and AHT
            </div>
            <div class="box-body">
                <canvas id="throughputAndAhtDailyChart"></canvas>
            </div>
        </div>
    </div>    
</template>

<script>
    import TPandAHT from './TPandAHT'
    export default {
        name: "BlackhawkCsManagementTPAndAHT_Daily",
        props: ['days'],
        data() {
            return {
                chart: '',
                labels: [],
                throughput: [],
                aht: [],
            }
        },
        methods: {
            render() {
                if (typeof this.chart == 'object') {
                    this.chart.destroy();                    
                }
                this.labels.reverse()
                this.throughput.reverse()
                this.aht.reverse()

                let ctx = document.getElementById('throughputAndAhtDailyChart').getContext('2d');
                let vm = this;
                this.chart = new Chart(ctx, {
                    type: 'line',
                    
                    data: {
                        labels: vm.labels,
                        datasets: [
                            {
                                label: "Daily TP",
                                yAxisID: 'throughput',
                                borderColor: 'rgba(39, 174, 96,.5)',
                                backgroundColor: 'rgba(39, 174, 96,.5)',
                                data: vm.throughput,
                                fill: false
                            },
                            {
                                label: "Daily AHT",
                                yAxisID: 'aht',
                                borderColor: 'rgba(39, 174, 96, 1.0)',
                                backgroundColor: 'rgba(39, 174, 96, 1.0)',
                                data: vm.aht,
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
                                    id: 'throughput',
                                    stacked: false
                                },                                
                                {
                                    position: 'right',
                                    id: 'aht',
                                    stacked: false,
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
            days() {
                this.labels = [];
                this.throughput = [];

                this.days.forEach(function(elem) {
                    this.labels.push(elem.date);
                    this.throughput.push(
                        TPandAHT.tp(elem.records, elem.time_logged_in)
                    );
                    this.aht.push(
                        TPandAHT.aht(elem.records, elem.production_time));
                }, this);

                return this.render();
            }
        }
    }
</script>

<style lang="css" scoped>
    #throughputAndAhtDailyChart {
        min-height: 200px;
        max-height: 280px;
    }
</style>