<template>
    <div>
        <div class="box box-success">
            <div class="box-header with-border">
               Two Months Ago Errors Count
            </div>
            <div class="box-body">
                <canvas id="twoMonthsAgoChart"></canvas>
            </div>
        </div>
    </div>    
</template>

<script>
    export default {
        name: "BlackHawkCsErrors_TwoMonthsAgo",
         props: ['two_months_ago'],
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
                let ctx = document.getElementById('twoMonthsAgoChart').getContext('2d');
                let vm = this;

                this.chart = new Chart(ctx, {
                    type: 'bar',                    
                    data: {
                        labels: vm.labels,
                        datasets: [
                            {
                                label: "Two Months Ago QA Errors",
                                backgroundColor: 'rgba(0,204,21, 0.2)',
                                borderColor: 'rgba(0,204,21, 0.6)',
                                borderWidth: 2,
                                hoverBackgroundColor: 'rgba(0,204,21, 0.4)',
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
            two_months_ago() {
                this.labels = [];
                this.data = [];
                let vm = this;     

                this.two_months_ago.forEach(function(elem) {
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