<script>
    export default {

        name: 'TPLineChart',

        data() {
            return {
                labels: [],
                tp: [],
            }
        },

        props: ['records', 'line-color'],

        watch: {
            records() {
                this.labels = [];
                this.tp = [];
                let vm = this;

                this.records.forEach(function(item, index) {
                    vm.totals.hours = vm.totals.hours + item.escalation_hours_production_hours;
                    vm.totals.records = vm.totals.records + item.records;
                });
            }
        },

        methods: {
            tp(record) {
                if (record.escalation_hours_production_hours && record.escalation_hours_production_hours > 0) {
                    return (record.records / record.escalation_hours_production_hours).toFixed(2);
                }
                return 0;
            },
            hours(record) {
                if (record.escalation_hours_production_hours) {
                    return (record.escalation_hours_production_hours).toFixed(2);
                }
                return 0;
            }
        },
        computed: {
            totalHours() {
                return this.totals.hours.toFixed(2)
            },
            totalRecords() {
                return this.totals.records
            },
            totalTp() {
                return this.totals.tp.toFixed(2)
            },
        }
    };
</script>

<template>
    <div class="_Table">

        <div class="box-body">
            <canvas id="tPLineChart"></canvas>
        </div>

    </div>
</template>

<style lang="css" scoped>
</style>