<template>
    <div>
        <div class="box box-success">
            <div class="box-header with-border">
                Daily QA Scores
            </div>
            <div class="box-body">
                <canvas id="qaDailyChart"></canvas>
            </div>
        </div>
    </div>    
</template>

<script>
    export default {
        name: "BlackhawkCsManagementQa_Daily",
        props: ['days'],
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
                let ctx = document.getElementById('qaDailyChart').getContext('2d');
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
                                borderWidth: 0,
                                pointStyle: 'line',
                                data: vm.goals
                            },
                            {
                                label: "Daily Scores",
                                yAxisID: 'scores',
                                backgroundColor: 'rgba(39, 174, 96,1.0)',
                                borderColor: 'rgba(39, 174, 96,1.0)',
                                data: vm.scores,
                                fill: false
                            },
                            {
                                label: "Daily Passing",
                                yAxisID: 'passing',
                                backgroundColor: 'rgba(46, 204, 113, .8)',
                                borderColor: 'rgba(46, 204, 113, .8)',
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
            days() {
                this.labels = [];
                this.scores = [];
                this.goals = [];
                this.passing = [];
                let vm = this;     

                this.days.forEach(function(elem) {
                    vm.labels.push(elem.date);
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
    #qaDailyChart {
        min-height: 200px;
        max-height: 280px;
    }
</style>