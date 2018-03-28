<template>
    <div>
        <div class="box box-primary">
            <div class="box-header with-border">
                Monthly QA Scores
            </div>
            <div class="box-body">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>    
</template>

<script>
    export default {
        name: "BlackhawkCsManagementQa_Monthly",
        props: ['months'],
        data() {
            return {
                chart: '',
                labels: [],
                scores: [],
                goals: [],
                passing: [],
            }
        },
        methods: {
            render() {
                if (typeof this.chart == 'object') {
                    this.chart.destroy();                    
                }
                this.labels.reverse()
                this.scores.reverse()
                this.passing.reverse()
                let ctx = document.getElementById('monthlyChart').getContext('2d');
                let vm = this;
                this.chart = new Chart(ctx, {
                    type: 'line',
                    
                    data: {
                        labels: vm.labels,
                        datasets: [
                            {
                                label: "Goal",
                                borderColor: 'rgba(192, 57, 43, .08)',
                                backgroundColor: 'rgba(192, 57, 43, .08)',
                                borderWidth:1,
                                pointStyle: 'line',
                                data: vm.goals
                            },
                            {
                                label: "Monthly Scores",
                                yAxisID: 'scores',
                                backgroundColor: 'rgba(41, 128, 185,1.0)',
                                borderColor: 'rgba(41, 128, 185,1.0)',
                                data: vm.scores,
                                fill: false
                            },
                            {
                                label: "Monthly Passing",
                                yAxisID: 'passing',
                                backgroundColor: 'rgba(52, 152, 219, .8)',
                                borderColor: 'rgba(52, 152, 219, .8)',
                                data: vm.passing,
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
                                    id: 'scores',
                                    stacked: false
                                },
                                {
                                    position: 'right',  
                                    id: 'passing',
                                    stacked: false ,
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
                this.scores = [];
                this.goals = [];
                this.passing = [];
                let vm = this;     

                this.months.forEach(function(elem) {
                    vm.labels.push(elem.year + "-" + elem.month.substr(0, 3));
                    vm.scores.push(elem.score.toFixed(2));
                    vm.goals.push(93);
                    vm.passing.push((elem.passing * 100).toFixed(2));
                });

                return this.render();
            }
        }
    }
</script>

<style lang="css" scoped>

</style>