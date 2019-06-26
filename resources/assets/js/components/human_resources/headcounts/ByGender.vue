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
        name: "ByGender",
        data() {
            return {
                labels: [],
                options: {
                    label: {display: true},
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "HeadCount By Genders"
                    }
                },
                datasets: [ {
                    label: "HeadCount By Genders",
                    data: [],
                    backgroundColor: [
                        "rgba(0, 166, 90, .80)",
                        "rgba(243, 156, 18, .80)",
                        "rgba(245, 15, 84, .80)",
                        "rgba(200, 35, 150, .80)",
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
                let vm = this

                let vmData = this.info

                vmData.sort(function(a, b) {
                    return b.employees_count - a.employees_count
                })

                vmData.forEach(function(item, index) {
                    vm.labels.push(item.name)
                    vm.datasets[0].data.push(item.employees_count)
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
