<template>
    <line-chart
        :labels="computedLabels"
        :datasets="computedDatasets"
        :options="options"
        :height="height"
    ></line-chart>
</template>

<script>
    import LineChart from '../charts/LineChart'
    import {DAINSYS} from '../../config/app'
    export default {
        name: "SitesOverview",
        data() {
            return {
                labels: [],
                options: {
                    label: {display: true},
                    legend: {display: false},
                    title: {
                        display: true,
                        text: this.title
                    }
                },
                datasets: [ {
                    label: this.title,
                    data: [],
                    backgroundColor: this.backgroundColor,
                    borderColor: this.borderColor,
                }],
            }
        },
        props: {
            info: {
                default: []
            },
            height: {default: 200},
            title: {default: ''},
            sortData: {type: Boolean},
            backgroundColor: {default: "rgba(0,150,136, 0.35)"},
            borderColor: {default: "rgba(0,150,136, 1)"},
        },
        components: {
            LineChart
        },
        computed: {
            computedLabels() {

                this.labels = []

                return this.labels = Object.keys(this.info)
            },
            computedDatasets() {
                this.datasets[0].data = []

                let data = Object.values(this.info);

                data = data.map(function(item) {
                    return Number(item).toFixed(2)
                })

                this.datasets[0].data = data
                return this.datasets = this.datasets
            }
        }
    }
</script>

<style lang="css" scoped>
    .employees-count {
        font-size: 4em;
    }
</style>
