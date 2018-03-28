<template>
    <div>
        <div class="box box-warning">
            <div class="box-header with-border">
                Previous Month Errors Count
            </div>
            <div class="box-body">
                <canvas id="previousMonthChart"></canvas>
            </div>
        </div>
    </div>    
</template>

<script>
    export default {
        name: "BlackHawkCsErrors_LastMonth",
         props: ['last_month'],
        data() {
            return {
                chart: '',
                labels: [],
                data: [],
            }
        },
        methods: {
            render() {
                if (typeof this.chart == 'object') {
                    this.chart.destroy();                    
                }
                let ctx = document.getElementById('previousMonthChart').getContext('2d');
                let vm = this;

                this.chart = new Chart(ctx, {
                    type: 'bar',
                    
                    data: {
                        labels: vm.labels,
                        datasets: [
                            {
                                label: "Previous Month QA Errors",
                                backgroundColor: 'rgba(255,83,13, 0.2)',
                                borderColor: 'rgba(255,83,13, 0.6)',
                                borderWidth: 2,
                                hoverBackgroundColor: 'rgba(255,83,13, 0.4)',
                                data: vm.data
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
                            xAxes: [{
                                gridLines: {
                                    offsetGridLines: true
                                }
                            }]
                        }
                    }
                });
            }
        },
        watch: {
            last_month() {
                this.labels = [];
                this.data = [];
                let vm = this;     

                this.last_month.forEach(function(elem) {
                    vm.labels.push(elem.error_field);
                    vm.data.push(elem.count);
                });

                return this.render();
            }
        }
    }
</script>

<style lang="css" scoped>

</style>