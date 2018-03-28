<template>
    <div>
        <div class="box box-warning">
            <div class="box-header with-border">
                Weekly Records
            </div>
            <div class="box-body">
                <canvas id="productionWeeklyChart"></canvas>
            </div>
        </div>
    </div>    
</template>

<script>
    export default {
        name: "BlackhawkCsManagementRecords_Weekly",
        props: ['weeks'],
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
                let ctx = document.getElementById('productionWeeklyChart').getContext('2d');
                let vm = this;
                this.chart = new Chart(ctx, {
                    type: 'line',
                    
                    data: {
                        labels: vm.labels,
                        datasets: [
                            {
                                label: "Weekly Records",
                                yAxisID: 'records',
                                backgroundColor: 'rgba(211, 84, 0, .25)',
                                borderColor: 'rgba(211, 84, 0, 1)',
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
                            intersect: false,
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
            weeks() {
                this.labels = [];
                this.records = [];
                let vm = this;     

                this.weeks.forEach(function(elem) {
                    vm.labels.push(elem.year + "-" + elem.week);
                    vm.records.push(Number(elem.records.toFixed(0)));
                });

                return this.render();
            }
        }
    }
</script>

<style lang="css" scoped>

</style>