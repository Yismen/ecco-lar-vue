<template>
    <div>
        <div class="box box-primary">
            <div class="box-header with-border">
                Current Month Errors Count
            </div>
            <div class="box-body">
                <canvas id="thisMonthChart"></canvas>
            </div>
        </div>
    </div>    
</template>

<script>
    export default {
        name: "BlackHawkCsErrors_ThisMonth",
         props: ['this_month'],
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
                let ctx = document.getElementById('thisMonthChart').getContext('2d');
                let vm = this;

                this.chart = new Chart(ctx, {
                    type: 'bar',
                    
                    data: {
                        labels: vm.labels,
                        datasets: [
                            {
                                label: "Current Month QA Errors",
                                backgroundColor: 'rgba(41, 128, 185, 0.2)',
                                borderColor: 'rgba(41, 128, 185, 0.6)',
                                borderWidth: 2,
                                hoverBackgroundColor: 'rgba(41, 128, 185, 0.4)',
                                data: vm.data
                            }
                        ]
                    },

                    // Configuration options go here
                    options: {
                        ticks: {
                            callback: function(value) {
                                console.log(value)
                                return value.substr(0, 10);//truncate
                            },
                        },
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
            this_month() {
                this.labels = [];
                this.data = [];
                let vm = this;     

                this.this_month.forEach(function(elem) {
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