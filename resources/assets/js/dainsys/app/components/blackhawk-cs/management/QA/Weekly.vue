<template>
    <div>
        <div class="box box-warning">
            <div class="box-header with-border">
                Weekly QA Scores
            </div>
            <div class="box-body">
                <canvas id="qaWeeklyChart"></canvas>
            </div>
        </div>
    </div>    
</template>

<script>
    export default {
        name: "BlackhawkCsManagementQa_Weekly",
        props: ['weeks'],
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
                let ctx = document.getElementById('qaWeeklyChart').getContext('2d');
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
                                borderWidth: 1,
                                pointStyle: 'line',
                                data: vm.goals
                            },
                            {
                                label: "Weekly Scores",
                                yAxisID: 'scores',
                                backgroundColor: 'rgba(211, 84, 0,1.0)',
                                borderColor: 'rgba(211, 84, 0,1.0)',
                                data: vm.scores,
                                fill: false
                            },
                            {
                                label: "Weekly Passing",
                                yAxisID: 'passing',
                                backgroundColor: 'rgba(211, 84, 0, .7)',
                                borderColor: 'rgba(211, 84, 0, .7)',
                                data: vm.passing,
                                fill: false
                            }
                        ]
                    },

                    // Configuration options go here
                    options: {
                        legend: false,
                        tooltips: {
                            intersect: true,
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
            weeks() {
                this.labels = [];
                this.scores = [];
                this.goals = [];
                this.passing = [];
                let vm = this;     

                this.weeks.forEach(function(elem) {
                    vm.labels.push(elem.year + "-" + elem.week);
                    vm.scores.push(elem.score);
                    vm.goals.push(93);
                    vm.passing.push(elem.passing * 100);
                });

                return this.render();
            }
        }
    }
</script>

<style lang="css" scoped>
    #qaWeeklyChart {
        min-height: 200px;
        max-height: 280px;
    }
</style>