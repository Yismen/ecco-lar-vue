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
    import LineChart from '../charts/LineChart'

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
                        text: "Monthly Attrition: " + this.site
                    },
                    scales: {
                        yAxes: [
                            {
                                type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                                display: true,
                                position: 'left',
                                id: 'head-count',
                                // grid line settings
                                gridLines: {
                                    drawOnChartArea: true, // only want the grid lines for one axis to show up
                                },
                            },
                            {
                                type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                                display: true,
                                position: 'right',
                                id: 'attrition',
                                // grid line settings
                                gridLines: {
                                    drawOnChartArea: false, // only want the grid lines for one axis to show up
                                },
                            }
                        ]
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    }
                },
                datasets: []
            }
        },
        props: ['info', 'site'],
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

                for (var key in this.info) {
                    let attr = vm.info[key].head_count
                    let terms = vm.info[key].terminations
                    vm.lab.push(key)
                    head_count.push(attr)
                    terminations.push(terms)
                    attritions.push(vm.getAttrition(attr, terms))
                }

                return this.datasets = [
                    {
                        label: "Attrition",
                        data: attritions,
                        backgroundColor: 'rgba(255,41,62, 0.85)',
                        borderColor: 'rgba(255,41,62,1)',
                        fill: false,
                        yAxisID: 'attrition'
                    },
                    {
                        label: "Head Count",
                        data: head_count,
                        backgroundColor: 'rgba(54, 162, 235, .35)',
                        borderColor: 'rgba(54, 162, 235, .9)',
                        fill: true,
                        yAxisID: 'head-count'
                    }
                ]
            }
        }
    }
</script>
