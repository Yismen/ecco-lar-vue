<template>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-warning">
                    <div class="box-body">
                        <line-chart
                            :labels="computedLabels"
                            :datasets="computedDatasets"
                            :options="options"
                            :height="200"
                        ></line-chart>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LineChart from '../../charts/LineChart'

    export default {
        name: "MonthlyAttrition",
        data() {
            return {
                labels: [],
                lab: [],
                options: {
                    label: {display: true},
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Montly Attrition"
                    },
                    scales: {
                        yAxes: [{
                            type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                            display: true,
                            position: 'left',
                            id: 'head-count',
                            // grid line settings
                            gridLines: {
                                drawOnChartArea: true, // only want the grid lines for one axis to show up
                            },
                        }, {
                            type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                            display: false,
                            position: 'left',
                            id: 'termination',
                            // grid line settings
                            gridLines: {
                                drawOnChartArea: false, // only want the grid lines for one axis to show up
                            },
                        }, {
                            type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                            display: true,
                            position: 'right',
                            id: 'attrition',
                            // grid line settings
                            gridLines: {
                                drawOnChartArea: false, // only want the grid lines for one axis to show up
                            },
                        }]
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    }
                },
                datasets: []
            }
        },
        props: ['info'],
        components: {
            LineChart
        },
        methods: {
            getAttrition(head_count, termination) {
                return (termination / head_count * 100).toFixed(2)
            }
        },
        computed: {
            computedLabels() {
                return this.lab
            },
            computedDatasets() {

                let vm = this
                let head_count = []
                let terminations = []
                let attritions = []

                for (var key in this.info[0]) {
                    let attr = vm.info[0][key].head_count
                    let terms = vm.info[0][key].terminations
                    vm.lab.push(key)
                    head_count.push(attr)
                    terminations.push(terms)
                    attritions.push(vm.getAttrition(attr, terms))
                }

                return this.datasets = [
                    {
                        label: "Head Count",
                        data: head_count,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 0.7)',
                        fill: false,
                        yAxisID: 'head-count'
                    },
                    {
                        label: "Terminations",
                        data: terminations,
                        backgroundColor: 'rgba(55,0,45, 0.7)',
                        borderColor: 'rgba(55,0,45, 0.7)',
                        fill: false,
                        yAxisID: 'termination'
                    },
                    {
                        label: "Attrition",
                        data: attritions,
                        backgroundColor: 'rgba(255,41,62,1)',
                        borderColor: 'rgba(255,41,62,1)',
                        fill: false,
                        yAxisID: 'attrition'
                    }
                ]
            }
        }
    }
</script>
