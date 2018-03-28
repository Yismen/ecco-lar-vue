<template>
    <div>
        <div class="box box-primary">
            <div class="box-header with-border">
                Monthly Records
            </div>
            <div class="box-body">
                <canvas id="productionMonthlyChart"></canvas>
            </div>
        </div>
    </div>    
</template>

<script>
    export default {
        name: "BlackhawkCsManagementRecords_Monthly",
        props: ['months'],
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
                let ctx = document.getElementById('productionMonthlyChart').getContext('2d');
                let vm = this;
                this.chart = new Chart(ctx, {
                    type: 'line',
                    
                    data: {
                        labels: vm.labels,
                        datasets: [
                            {
                                label: "Monthly Records",
                                yAxisID: 'records',
                                backgroundColor: 'rgba(41, 128, 185,.25)',
                                borderColor: 'rgba(41, 128, 185,1.0)',
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
            months() {
                this.labels = [];
                this.records = [];
                let vm = this;     

                this.months.forEach(function(elem) {
                    vm.labels.push(elem.year + "-" + elem.month.substr(0, 3));
                    vm.records.push(Number(elem.records.toFixed(0)));
                });

                return this.render();
            }
        }
    }
</script>

<style lang="css" scoped>

</style>