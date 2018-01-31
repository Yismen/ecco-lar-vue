<template>
    <div class="_LastFiveDates">
        <div class="box box-info">
            <div class="box-header with-border">
                 <h4>
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
                                borderColor: "rgba(41, 128, 185,1.0)",
                                backgroundColor: "rgba(41, 128, 185,1.0)",
                                fill: false
                            },
                            {
                                label: 'BBB Records by Date',
                                yAxisID: 'bbb',
                                data: vm.bbbRecords,
                                borderColor: 'rgba(211, 84, 0,1.0)',
                                backgroundColor: 'rgba(211, 84, 0,1.0)',
                                fill: false
                            }
                        ]
                        
                    },
                    options: {
                        title: {
                            display: true,
                            text: "Escalations Records and Records Marked as BBB"
                        },
                        legend: false,
                        tooltips: {
                            intersect: false,
                             mode: 'index'
                        },
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
                                    position: 'right',
                                    gridLines: {
                                        display: false
                                    }
                                }
                            ],                            
                            xAxes: [{
                                gridLines: {
                                    display: false
                                }
                            }]
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
                    vm.labels.push(vm.parseLabel(item.insert_date))
                    vm.recordsCreated.push(item.records);
                    vm.bbbRecords.push(item.bbbRecords);
                });

                this.labels.reverse();
                this.recordsCreated.reverse();
                this.bbbRecords.reverse();
            },
            parseLabel(date) {
                date = new Date(date);
                return String(date.getFullYear() + '-' + date.getMonth() + 1 + '-' + date.getDate());
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