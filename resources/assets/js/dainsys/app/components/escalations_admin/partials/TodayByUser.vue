<template>
    <div class="_LastFiveDates">
        <div class="box box-info">
            <div class="box-header">
                <h5 class="page-header">
                    <a href="/admin/escalations_admin/by_date">Records Enteredy by Users Today</a>
                </h5>
            </div>
            <div class="box-body">
                <canvas id="recordsByUser" height="150"></canvas>
            </div>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js';
    export default {

        name: 'TodayByUser',

        props: ['records'],

        data () {
            return {
                labels: [],
                recordsCreated: []
            };
        },

        watch: {
            records() {
                let ctx = document.getElementById("recordsByUser");
                let vm = this;

                this.updateInfo();

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: vm.labels,
                        datasets: [{
                            label: 'Records By User',
                            data: vm.recordsCreated,
                            backgroundColor: [
                                'rgba(255, 159, 64, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(26, 188, 156, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(153, 102, 255, 1)',
                            ],
                        }]
                        
                    },
                    options: {
                    }
                });

            }
        },

        methods: {
            updateInfo() {
                this.labels = [];
                this.recordsCreated = [];
                let vm = this;

                this.records.forEach(function(item, index) {
                    vm.labels.push(item.name)
                    vm.recordsCreated.push(item.escalations_records_count);
                });

                this.labels.reverse();
                this.recordsCreated.reverse();
            }
        },

        computed: {
            fetchedRecords() {
                return this.records;
            }
        }
    };
</script>

<style lang="css" scoped>
</style>