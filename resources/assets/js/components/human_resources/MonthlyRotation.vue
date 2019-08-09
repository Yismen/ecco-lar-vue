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
        name: "MonthlyRotations",
        data() {
            return {
                labels: [],
                lab: [],
                options: {
                    label: {display: true},
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Monthly HC / Rotations: " + this.site
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
        computed: {
            computedLabels() {
                return this.lab
            },
            computedDatasets() {
                let vm = this
                let hires = []
                let terminations = []

                for (var key in this.info) {
                    let hired = vm.info[key].hires
                    let term = vm.info[key].terminations

                    vm.lab.push(key)
                    hires.push(hired)
                    terminations.push(term)
                }

                return this.datasets = [

                    {
                        label: "Terminations",
                        display: false,
                        data: terminations,
                        backgroundColor: 'rgba(255,41,62,.25)',
                        borderColor: 'rgba(255,41,62,1)',
                        fill: false
                    },
                    {
                        label: "Hires",
                        data: hires,
                        backgroundColor: 'rgba(102,187,106 ,.25)',
                        borderColor: 'rgba(102,187,106 ,1)'
                    }
                ]
            }
        }
    }
</script>
