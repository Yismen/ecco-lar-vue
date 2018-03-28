export default class LineChart {
    constructor(options = {}) {
        this.default = Object.assign({ 
            chart: '', 
            labels: [], 
            datasets: [],
            ctx: document.getElementById('monthlyChart').getContext('2d'),
            goal: 93,
            goalArray: [], 
            goalLine: this.goalLine()
        }, options);
    }    

    labels(labels = []) {
        return this.labels = labels
    }

    dataset(options) {
        this.datasets.push(Object.assign({
            label: "Monthly Scores",
            yAxisID: 'scores',
            backgroundColor: 'rgba(41, 128, 185 ,1.0)',
            borderColor: 'rgba(41, 128, 185 ,1.0)',
            data: [],
            fill: false
        }, options));
    }
    
    setGoalArray() {
        let vm = this;
        vm.labels.forEach(element => {
            vm.goalArray.push(vm.goal);
        })
    }
    goalLine() {
        this.goalArray = [];
        this.setGoalArray();

        return {
            label: "Goal",
            backgroundColor: 'rgba(192, 57, 43, .08)',
            borderWidth: 0,
            pointStyle: 'line',
            data: vm.goals
        }
    }

    datasets(datadaset) {
        return this.dataset.push(dataset);
    }

    render() {
        if (typeof this.chart == 'object') {
            this.chart.destroy();
        }
        let vm = this;
        this.chart = new Chart(this.ctx, {
            type: 'line',
            data: {
                labels: vm.labels,
                datasets: vm.datasets()
            },

            // Configuration options go here
            options: {
                legend: false,
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
                            stacked: true,
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
}