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
                        xAxes: [{ stacked: true }],
                        yAxes: [{ stacked: true }]
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
                        fill: false
                    },
                    // {
                    //     label: "Terminations",
                    //     data: terminations,
                    //     backgroundColor: 'rgba(55,0,45, 0.7)',
                    //     borderColor: 'rgba(55,0,45, 0.7)',
                    //     fill: false
                    // },
                    {
                        label: "Attrition",
                        data: attritions,
                        backgroundColor: 'rgba(255, 206, 86, 0.7)',
                        borderColor: 'rgba(255, 206, 86, 0.7)',
                        fill: false
                    }
                ]
            }
        }
    }
</script>
