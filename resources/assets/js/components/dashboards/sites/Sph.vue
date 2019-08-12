<template>
    <bar-chart
        :labels="computedLabels"
        :datasets="computedDatasets"
        :options="options"
        :height="height"
    ></bar-chart>
</template>

<script>
    import BarChart from '../../charts/BarChart'
    export default {
        name: "SitesOverview",
        data() {
            return {
                labels: [],
                options: {
                    label: {display: true},
                    legend: {display: false},
                    responsive: true,
                    title: {
                        display: true,
                        text: this.title
                    },
                    scales: {

                        yAxes: [
                            {
                                id: 'sph',
                            },
                            {
                                id: 'goal',
                            },
                            {
                                type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                                position: 'right',
                                id: '%_to_goal',
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
                datasets: [],
            }
        },
        props: {
            info: {
                default: []
            },
            height: {default: 200},
            title: {default: ''},
        },
        components: {
            BarChart
        },
        computed: {
            computedLabels() {

                this.labels = []

                return this.labels = Object.keys(this.info)
            },
            computedDatasets() {
                this.datasets = []

                let data = Object.values(this.info);

                let datasets = [
                    {
                        type: 'line',
                        label: '% To Goal',
                        backgroundColor: 'rgba(0,77,64 ,0.5)',
                        borderColor: 'rgba(0,77,64 ,1)',
                        data: [],
                        yAxisID: '%_to_goal',
                        fill: false,
                    },
                    {
                        label: 'SPH',
                        backgroundColor: 'rgba(255,87,34 , .75)',
                        borderColor: 'rgba(255,87,34 , .35)',
                        data: [],
                        yAxisID: 'sph'
                    },
                    {
                        label: 'GOAL',
                        backgroundColor: 'rgba(25,118,210 , .75)',
                        borderColor: 'rgba(25,118,210 , .35)',
                        data: [],
                        yAxisID: 'goal'
                    }
                ]

                data.forEach(function (element) {
                    datasets[0].data.push(element['%_to_goal'].toFixed(2))
                    datasets[1].data.push(element['sph'].toFixed(3))
                    datasets[2].data.push(element['sph_goal'].toFixed(3))
                })

                return this.datasets = datasets
            }
        }
    }
</script>

<style lang="css" scoped>
    .employees-count {
        font-size: 4em;
    }
</style>
