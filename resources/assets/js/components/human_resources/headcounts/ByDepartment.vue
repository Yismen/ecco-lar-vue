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
    import {DAINSYS} from '../../../config/app'
    export default {
        name: "ByDepartment",
        data() {
            return {
                labels: [],
                options: {
                    label: {display: true},
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "Departments: " + this.site
                    }
                },
                datasets: [ {
                    label: "HeadCount By Departments",
                    data: [],
                    backgroundColor: DAINSYS.getColors()
                }],
            }
        },
        props: ['info', 'site'],
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
