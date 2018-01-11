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
    export default {

        name: 'PayrollsIndex',

        data () {
            return {
            };
        },

        components: {
            'generate-form': require('./partials/PayrollsGeneratorForm'),
            'employees-with-hours': require('./partials/employee-lists/_WithHoursList'),
            'employees-without-hours': require('./partials/employee-lists/_WithoutHoursList'),
        }
    };
</script>

<style lang="css" scoped>
</style>