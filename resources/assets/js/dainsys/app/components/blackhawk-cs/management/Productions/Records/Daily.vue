<template>
    <div>
        <div class="box box-success">
            <div class="box-header with-border">
                Daily Records
            </div>
            <div class="box-body">
                <canvas id="productionDailyChart"></canvas>
            </div>
        </div>
    </div>    
</template>

<script>
    export default {
        name: "BlackhawkCsManagementRecords_Daily",
        props: ['days'],
        data() {
            return {
                chart: '',
                labels: [],
                records: [],
            }
        },
        methods: {
            render() {
                if (typeof this.chart == 'object') {
                    this.chart.destroy();                    
                }
                this.labels.reverse()
                this.records.reverse()
                let ctx = document.getElementById('productionDailyChart').getContext('2d');
                let vm = this;
                this.chart = new Chart(ctx, {
                    type: 'line',
                    
                    data: {
                        labels: vm.labels,
                        datasets: [
                            {
                                label: "Daily Records",
                                yAxisID: 'records',
                                backgroundColor: 'rgba(39, 174, 96, .25)',
                                borderColor: 'rgba(39, 174, 96, 1)',
                                data: vm.records,
                                // fill: false
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
                                    id: 'records',
                                    stacked: false
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
                this.records = [];
                let vm = this;     

                this.days.forEach(function(elem) {
                    vm.labels.push(elem.date);
                    vm.records.push(Number(elem.records));
                });

                return this.render();
            }
        }
    }
</script>

<style lang="css" scoped>
    #productionDailyChart {
        min-height: 200px;
        max-height: 280px;
    }
</style>