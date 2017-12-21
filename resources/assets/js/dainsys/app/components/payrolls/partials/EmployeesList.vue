<template>
    <div class="_EmployeesList">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="box box-warning">
                <employees-without-hours :employees="employees.actives_without_hours"></employees-without-hours>
            </div>
            <div class="box box-primary">
                <employees-with-hours :employees="employees.employees_with_hours"></employees-with-hours>
            </div>
        </div>

    </div>
</template>

<script>
    export default {

        name: 'EmployeesList',

        props: ['employees'],

        computed: {
            hasEmployees() {
                return this.employees && this.employees.length > 0 ? true : false; 
            }
        },

        components: {
            'employees-with-hours': require('./employee-lists/_WithHoursList'),
            'employees-without-hours': require('./employee-lists/_WithoutHoursList'),
        },

        filters: {
            // currency(amount) {
            //     return '$'+amount;
            // }
        },

        methods: {
            changeAll() {
                console.log(this.all)
            }
        }
    };
</script>

<style lang="css" scoped>
</style>