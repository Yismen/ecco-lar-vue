<template>
    <div class="Payrolls_Index">
        <div class="box-header with-border">
            Generate Payroll Roll
        </div>

        <div class="box-body">
            <generate-form @payroll-generated="payrollGenerated"></generate-form>
        </div>

        <div class="box-body">
            <employees-list :employees="employeesList"></employees-list>
        </div> 
    </div>
</template>

<script>
    export default {

        name: 'PayrollsIndex',

        data () {
            return {
                employees: []
            };
        },

        computed: {
            employeesList() {
                return this.employees;
            }
        },

        methods: {
            payrollGenerated(response) {
                this.employees = response.employees;
            }
        },

        components: {
            'generate-form': require('./partials/PayrollsGeneratorForm'),
            'employees-list': require('./partials/EmployeesList')
        }
    };
</script>

<style lang="css" scoped>
</style>