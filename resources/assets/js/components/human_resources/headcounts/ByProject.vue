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
                            :height="height"
                        ></doughnut-chart>
                    </div>
                    <div class="box-footer">
                        <a href="/admin/human_resources/head_count/by_project" title="View Details by Project"
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
        name: "ByProject",
        data() {
            return {
                labels: [],
                options: {
                    label: {display: true},
                    legend: {display: false},
                    title: {
                        display: true,
                        text: "HeadCount By Projects"
                    }
                },
                datasets: [ {
                    label: "HeadCount By Projects",
                    data: [],
                    backgroundColor: [
                        "rgba(0, 166, 90, .80)",
                        "rgba(243, 156, 18, .80)",
                        "rgba(245, 15, 84, .80)",
                        "rgba(200, 35, 150, .80)",
                        "rgba(255, 195, 0, 0.8)",
                        "rgba(218, 247, 166, 0.8)",
                        "rgba(249, 235, 234, 0.8)",
                        "rgba(245, 183, 177, 0.8)",
                        "rgba(215, 189, 226, 0.8)",
                        "rgba(84, 153, 199, 0.8)",
                        "rgba(195, 155, 211, 0.8)",
                        "rgba(247, 220, 111, 0.8)",
                        "rgba(217, 136, 128, 0.8)",
                        "rgba(133, 193, 233, 0.8)",
                        "rgba(240, 178, 122, 0.8)",
                        "rgba(215, 219, 221, 0.8)",
                    ]
                }],
            }
        },
        props: {
            info: {
                default: []
            },
            height: {default: 200}
        },
        components: {
            DoughnutChart
        },
        computed: {
            computedDatasets() {
                let vm = this

                this.info.forEach(function(item, index) {
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
