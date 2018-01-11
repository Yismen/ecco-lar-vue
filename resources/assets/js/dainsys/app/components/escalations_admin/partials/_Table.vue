<script>
    export default {

        name: 'Table',

        data() {
            return {
                totals: {
                    hours: 0,
                    records: 0,
                    tp: 0
                }
            }
        },

        props: ['records'],

        watch: {
            records() {
                this.totals.hours = 0;
                this.totals.records = 0;
                this.totals.tp = 0;
                let vm = this;

                this.records.forEach(function(item, index) {
                    vm.totals.hours = vm.totals.hours + item.escalation_hours_production_hours;
                    vm.totals.records = vm.totals.records + item.records;
                });
                this.totals.tp = this.totals.hours > 0 ? 
                    this.totals.records / this.totals.hours :
                    0
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

        <div class="box-header with-border">
            <h4>
                <slot>I'm the main header. Please replace me</slot>
            </h4>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Agent</th>
                            <th>Client</th>
                            <th>Hours</th>
                            <th>Records</th>
                            <th>TP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="record in records">
                            <td>{{ record.escal_records_insert_date }}</td>
                            <td>{{ record.user.name }}</td>
                            <td>{{ record.escal_client.name }}</td>
                            <td>{{ hours(record) }}</td>
                            <td>{{ record.records }}</td>
                            <td>{{ tp(record) }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">Totals:</th>
                            <th>{{ totalHours }}</th>
                            <th>{{ totalRecords }}</th>
                            <th>{{ totalTp }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</template>

<style lang="css" scoped>
</style>