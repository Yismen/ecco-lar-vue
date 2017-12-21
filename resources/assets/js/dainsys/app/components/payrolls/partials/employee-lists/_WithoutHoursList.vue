<template>
    <div class="_WithHoursList">
        <div class="box-body">
            <div class="table-responsive" v-if="hasEmployees">
                <div class="box-header"><h3>Employees who does not have hours reported</h3></div>
                <table class="table table-condensed table-bordered">
                    <thead>
                        <tr>                        
                            <th>Name</th>
                            <th>Position</th>
                            <th>Salary Composition</th>
                            <th>Salary Per Hour</th>
                            <th>Total Hours</th>
                            <th>Total Incomes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="employee in employees">
                            <!-- <td v-text="All()"></td> -->
                            <td v-text="employee.full_name"></td>
                            <td v-text="employee.position.name_and_department"></td>
                            <td>{{ employee.position.payment_type.name }}, {{ employee.position.payment_frequency.name }}</td>
                            <td>{{ employee.position.pay_per_hours | currency }}</td>
                            <td>{{ getTotalHours(employee) | currency('') }}</td>
                            <td>{{ getTotalHours(employee) * employee.position.pay_per_hours | currency }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="alert alert-info" v-else>
                <strong>Crap!</strong> I dont have any employee to show you with these criterias. Please redifine your search.
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        name: 'WithoutHoursList',

        props: ['employees'],

        computed: {
            hasEmployees() {
                return this.employees && this.employees.length > 0 ? true : false;
            }
        },

        methods: {            
            getTotalHours(employee) {
                return employee.hours.reduce(function(sum, elem) {
                    return sum + elem.regulars + elem.nightly + elem.overtime + elem.training + elem.holidays;
                }, 0);
            }
        }
    };
</script>

<style lang="css" scoped>
</style>