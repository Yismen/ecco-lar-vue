<template>
    <div class="_LastFiveDates">
        <div class="box box-info">
            <div class="box-header">
                 <h4 class="page-header">
                    <a href="/admin/escalations_admin/by_date"><i class="fa fa-star"></i> Pull Production</a>
                    <a href="/admin/escalations_admin/bbbs" class="pull-right"><i class="fa fa-envelope"></i> Pull BBBs</a>
                </h4>
            </div>
            <div class="box-body">
                <canvas id="lastFiveDatesChart" height="100"></canvas>
            </div>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js';
    export default {

        name: 'LastFiveDates',

        props: ['records'],

        data () {
            return {
                labels: [],
                recordsCreated: [],
                bbbRecords: []
            };
        },

        watch: {
            records() {
                let ctx = document.getElementById("lastFiveDatesChart");
                let vm = this;

                this.updateInfo();

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: vm.labels,
                        datasets: [
                            {
                                label: 'Records Entered Last Five Dates',
                                yAxisID: 'records',
                                data: vm.recordsCreated,
                                backgroundColor: "rgba(22, 160, 133, 0.5)",
                            },
                            {
                                label: 'BBB Records by Date',
                                yAxisID: 'bbb',
                                data: vm.bbbRecords,
                                backgroundColor: "rgba(230, 126, 34, 0.5)",
                            }
                        ]
                        
                    },
                    options: {
                        scales: {
                            yAxes: [
                                {
                                    id: 'records',
                                    type: 'linear',
                                    position: 'left'
                                },
                                {
                                    id: 'bbb',
                                    type: 'linear',
                                    position: 'right'
                                }
                            ]
                        }
                    }
                });

            }
        },

        methods: {
            updateInfo() {
                this.labels = [];
                this.recordsCreated = [];
                this.bbbRecords = [];
                let vm = this;

                this.records.forEach(function(item, index) {
                    vm.labels.push(item.insert_date)
                    vm.recordsCreated.push(item.records);
                    vm.bbbRecords.push(item.bbbRecords);
                });

                this.labels.reverse();
                this.recordsCreated.reverse();
                this.bbbRecords.reverse();
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