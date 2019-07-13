<template>
    <doughnut-chart
        :labels="labels"
        :datasets="computedDatasets"
        :options="options"
        :height="height"
    ></doughnut-chart>
</template>

<script>
    import DoughnutChart from '../../charts/DoughnutChart'
    import {DAINSYS} from '../../../config/app'
    export default {
        name: "ByProject",
        data() {
            return {
                labels: [],
                options: {
                    label: {display: true},
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Projects: " + this.site
                    }
                },
                datasets: [ {
                    label: "HeadCount By Projects",
                    data: [],
                    backgroundColor: DAINSYS.getColors()
                }],
            }
        },
        props: {
            info: {
                default: []
            },
            height: {default: 200},
            site: {default: ''}
        },
        components: {
            DoughnutChart
        },
        computed: {
            computedDatasets() {
                let vm = this

                let vmData = this.info

                vmData.sort(function(a, b) {
                    return b.employees_count - a.employees_count
                })

                vmData.forEach(function(item, index) {
                    if (item.employees_count && item.employees_count > 0) {
                        vm.labels.push(item.name)
                        vm.datasets[0].data.push(item.employees_count)
                    }
                })
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
