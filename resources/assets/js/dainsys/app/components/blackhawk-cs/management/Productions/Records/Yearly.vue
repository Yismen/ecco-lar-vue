<template>
    <div>
        <div class="box box-success">
            <div class="box-header with-border">
                Yearly Records
            </div>
            <div class="box-body">
                <canvas id="productionYearlyChart"></canvas>
            </div>
        </div>
    </div>    
</template>

<script>
    export default {
        name: "BlackhawkCsManagementRecords_Yearly",
        props: ['years'],
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
                let ctx = document.getElementById('productionYearlyChart').getContext('2d');
                let vm = this;
                this.chart = new Chart(ctx, {
                    type: 'line',
                    
                    data: {
                        labels: vm.labels,
                        datasets: [
                            {
                                label: "Yearly Records",
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
            years() {
                this.labels = [];
                this.records = [];
                let vm = this;     

                this.years.forEach(function(elem) {
                    vm.labels.push(elem.year);
                    vm.records.push(Number(elem.records.toFixed(0)));
                });

                return this.render();
            }
        }
    }
</script>

<style lang="css" scoped>

</style>