<template>
    <div>
        <div class="row">
            <div class="col-sm-3">
                <div class="box box-primary">
                    <div class="box-body">
                        <h4>Active Employees:</h4>
                        <h3 class="pull-right employees-count">{{ employees }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box box-primary">
                    <div class="box-body">
                        <doughnut-chart
                            :datasets="computedDatasets" :labels="labels" :options="options" :height="200"
                        ></doughnut-chart>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import DoughnutChart from '../../../charts/DoughnutChart'
    import {API} from '../../../../config/config'
    export default {
        name: "Dashboard",
        data() {
            return {
                employees: 0,
                datasets: [ { label: "Users Activities", data: [8, 15], backgroundColor: [
                        "rgba(150, 45, 25, 1)",
                        "rgba(30, 200, 90, 1)",
                        "rgba(200, 35, 150, 1)",
                    ] }],
                labels: ["Label1", "label2"],
                options: {legend: {display: false}},
                colors:  [
                        "rgba(150, 45, 25, 1)",
                        "rgba(30, 200, 90, 1)",
                        "rgba(200, 35, 150, 1)",
                        "rgba(200, 35, 150, 1)",
                        "rgba(200, 35, 150, 1)",
                        "rgba(200, 35, 150, 1)",
                        "rgba(200, 35, 150, 1)",
                    ]
            }
        },
        components: {
            DoughnutChart
        },
        computed: {
            computedDatasets() {
                return this.datasets
            }
        },
        methods: {
            getDashboardData() {
                let vm = this
                this.datasets = [];
                this.labels = [];

                axios.get(API + '/blackhawk/de/management')
                    .then(response => {
                        let data = [];
                        let colors = [];
                        vm.employees = response.data.employees,

                        response.data.positions.forEach(function(item, index) {
                            data.push(item.employees_count)
                            vm.labels.push(item.name)
                            colors.push(vm.colors[index])
                        })
                        vm.datasets = [{ label: "Users Activities", data: data, backgroundColor: colors }]

                        // console.log(vm.datasets, vm.labels)
                    })
            }
        },
        mounted() {
            this.getDashboardData()
        },
    }
</script>

<style lang="css" scoped>
    .employees-count {
        font-size: 4em;
    }
</style>