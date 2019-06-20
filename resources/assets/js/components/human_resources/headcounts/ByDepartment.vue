<template>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <doughnut-chart
                            :labels="labels"
                            :datasets="computedDatasets"
                            :options="options"
                            :height="200"
                        ></doughnut-chart>
                    </div>
                    <div class="box-footer">
                        <a href="/admin/human_resources/head_count/by_department" title="View Details by Departments"
                        target="_employees_">
                            <i class="fa fa-eye"></i> Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import DoughnutChart from '../../charts/DoughnutChart'
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
                        text: "HeadCount By Departments"
                    }
                },
                datasets: [ {
                    label: "HeadCount By Departments",
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
