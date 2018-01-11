<template>
    <div class="_WithHoursList">
        <div class="col-sm-10 col-sm-offset-1" v-if="isGenerated">
            <div class="box" :class="{'collapsed-box': collapse, 'box-warning': hasEmployees, 'box-success': !hasEmployees}">
                <div class="">
                    <div class="table-responsive">
                        <div class="box-header">
                            <h3>Employees who does not have hours reported <span class="badge" :class="{'bg-yellow': hasEmployees, 'bg-green': !hasEmployees}">{{ count }}</span></h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" @click="collapse = !collapse" v-if="collapse"><i class="fa fa-plus"></i></button>
                                <button type="button" class="btn btn-box-tool" @click="collapse = !collapse"  v-else><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body" v-show="!collapse" v-if="hasEmployees">
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
                    </div>

                    <div class="box-body" v-if="!hasEmployees">
                        <div class="alert alert-success">
                            <strong>Well!</strong> All the hourly employees have hours reported by the given criterias in the search box...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        name: 'WithoutHoursList',

        data() {
            return {
                collapse: true
            }
        },

        computed: {
            isGenerated(){
                return this.$store.state.PayrollStore.generated;
            },
            hasEmployees() {
                return this.employees && this.employees.length > 0 ? true : false;
            },
            employees() {
                return this.$store.state.PayrollStore.employees.actives_without_hours;
            },
            count() {
                return this.employees.length;
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
    .hidden-box {
        display: none;
    }
</style>