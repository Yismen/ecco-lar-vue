<template>
     <doughnut-chart
            :labels="labels"
            :datasets="computedDatasets"
            :options="options"
            :height="200"
        ></doughnut-chart>
</template>

<script>
    import DoughnutChart from '../../charts/DoughnutChart'

    export default {
        name: "ByStatus",
        data() {
            return {
                labels: ["Actives", "Inactives"],
                options: {
                    label: {display: true},
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "HeadCount By Status"
                    }
                },
                datasets: [ {
                    label: "HeadCount By Status",
                    data: [],
                    backgroundColor: [
                        "rgba(0,150,136,1)",
                        "rgba(233,30,99,1)",
                        "rgba(245, 15, 84, .8)",
                        "rgba(200, 35, 150, .8)",
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
                    this.info['actives'],
                    this.info['inactives']
                ]

                return this.datasets = this.datasets
            }
        }
    }
</script>
