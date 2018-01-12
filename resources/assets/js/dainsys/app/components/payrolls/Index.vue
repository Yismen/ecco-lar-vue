<template>
    <div class="Payrolls_Index">
    
        <div class="box-body">
            <generate-form></generate-form>
        </div>

        <div class="box-body">
            <employees-without-hours></employees-without-hours>
            <employees-with-hours></employees-with-hours>
        </div> 
    </div>
</template>

<script>
    import EmployeesWithHours from './partials/employee-lists/_WithHoursList'
    import GenerateForm from './partials/PayrollsGeneratorForm'
    import EmployeesWithoutHours from './partials/employee-lists/_WithoutHoursList'
    export default {

        name: 'PayrollsIndex',

        data () {
            return {
            };
        },

        components: {
            GenerateForm, EmployeesWithHours, EmployeesWithoutHours
        }
    };
</script>

<style lang="css" scoped>
</style>