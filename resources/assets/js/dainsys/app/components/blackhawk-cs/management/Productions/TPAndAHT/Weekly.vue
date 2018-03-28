<template>
    <div>
        <div class="box box-warning">
            <div class="box-header with-border">
                Weekly TP and AHT
            </div>
            <div class="box-body">
                <canvas id="throughputAndAhtWeeklyChart"></canvas>
            </div>
        </div>
    </div>    
</template>

<script>
    export default {
        name: "BlackhawkCsManagementTPAndAHT_Weekly",
        props: ['weeks'],
        data() {
            return {
                chart: '',
                labels: [],
                throughput: [],
                aht: [],
            }
        },
        methods: {
            getThroughput(records, hours) {
                let throughput = hours > 0 ? 
                    records / hours :
                    0;
                return Number(throughput.toFixed(2));
            },

            getATH(records, hours) {
                let throughput = records > 0 ? 
                    hours * 60 / records :
                    0;
                return Number(throughput.toFixed(2));
            },
            render() {
                if (typeof this.chart == 'object') {
                    this.chart.destroy();                    
                }
                this.labels.reverse()
                this.throughput.reverse()
                this.aht.reverse()

                let ctx = document.getElementById('throughputAndAhtWeeklyChart').getContext('2d');
                let vm = this;
                this.chart = new Chart(ctx, {
                    type: 'line',
                    
                    data: {
                        labels: vm.labels,
                        datasets: [
                            {
                                label: "Weekly TP",
                                yAxisID: 'throughput',
                                borderColor: 'rgba(211, 84, 0,.5)',
                                backgroundColor: 'rgba(211, 84, 0,.5)',
                                data: vm.throughput,
                                fill: false
                            },
                            {
                                label: "Weekly AHT",
                                yAxisID: 'aht',
                                borderColor: 'rgba(211, 84, 0, 1.0)',
                                backgroundColor: 'rgba(211, 84, 0, 1.0)',
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
                            intersect: false,
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
            weeks() {
                this.labels = [];
                this.throughput = [];

                this.weeks.forEach(function(elem) {
                    this.labels.push(elem.year + "-" + elem.week);
                    this.throughput.push(
                        this.getThroughput(elem.records, elem.time_logged_in)
                    );
                    this.aht.push(
                        this.getATH(elem.records, elem.production_time));
                }, this);

                return this.render();
            }
        }
    }
</script>

<style lang="css" scoped>

</style>