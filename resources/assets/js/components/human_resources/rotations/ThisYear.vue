<template>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-warning">
                    <div class="box-body">
                        <doughnut-chart
                            :labels="labels"
                            :datasets="computedDatasets"
                            :options="options"
                            :height="200"
                        ></doughnut-chart>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import DoughnutChart from '../../charts/DoughnutChart'

    export default {
        name: "ThisYear",
        data() {
            return {
                labels: ["Hires", "Terminations"],
                options: {
                    label: {display: true},
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Rotations This Year"
                    }
                },
                datasets: [ {
                    label: "Rotations This Year",
                    data: [],
                    backgroundColor: [
                        "rgba(84, 153, 199, 0.8)",
                        "rgba(195, 155, 211, 0.8)",
                    ]
                }],
            }
        },
        props: ['info'],
        components: {
            DoughnutChart
        },
        computed: {
            computedDatasets() {
                this.datasets[0].data = []

                this.datasets[0].data = [
                    this.info['hires'],
                    this.info['terminations']
                ]

                return this.datasets = this.datasets
            }
        }
    }
</script>
