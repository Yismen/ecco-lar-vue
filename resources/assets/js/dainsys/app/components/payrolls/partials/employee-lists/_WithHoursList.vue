<template>
    <div class="_WithHoursList">
        <div class="box-body">
            <div class="table-responsive" v-if="hasEmployees">
                <div class="box-header">
                    <h3>
                        <div class="col-sm-6">Employees With Hours </div>

                        <form method="POST" role="form" 
                            class="form-horizontal pull-right col-sm-6" 
                            v-if="selectedEmployees.length > 0"
                            @submit.prevent="closePayroll">
                            <div class="form-group">
                                <label for="date" class="label-control col-sm-2 hidden-xs">Date:</label>
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <datepicker input-class="form-control" 
                                            v-model="form.fields.payment_date" 
                                            name="payment_date" 
                                            id="payment_date"
                                            format="MM/dd/yyyy" 
                                            placeholder="From Date"
                                            :bootstrapStyling="true"
                                            :calendarButton="true"
                                            calendarButtonIcon="fa fa-calendar"
                                            :clearButton="true"
                                        ></datepicker>
                                        <span class="text-danger" v-show="form.error.has('payment_date')">{{ form.error.get('payment_date') }}</span>                              
                                    </div>
                                    <button type="submit" class="btn btn-warning col-sm-6">Close Payroll</button>
                                </div>
                                    
                            </div>                    
                        </form>
                    </h3>

                </div>
                <table class="table table-hover table-condensed table-bordered">
                    <thead>
                        <tr>                        
                            <th>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" v-model="selected" @change="checkboxAllChanged">
                                        <strong>Employee ID (All)</strong>
                                    </label>
                                </div>
                            </th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Salary Composition</th>
                            <th>Paymen Per Hours</th>

                            <th>Regular Salary</th>
                            <th>Nightly Salary</th>
                            <th>Overtime Salary</th>
                            <th>Holiday Salary</th>
                            <th>Trainig Salary</th>

                            <th>Incentives</th>
                            <th>Other Incomes</th>

                            <th>ARS Discount</th>
                            <th>AFP Discount</th>
                            <th>Other Discounts</th>
                            
                            <th>TSS Amount</th>
                            <th>Gross Amount</th>
                            <th>Net Amount</th>
                            <th>Payment Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <payroll-line v-for="employee in employees" :key="employee.id" :employee="employee"></payroll-line>                        
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
    import payrollLineComponent from './../PayrollLine';
    import Event from './../../../../../vendor/dainsys-event';
    import Form from './../../../../../vendor/dainsys-form';

    export default {

        name: 'WithHoursList',

        data() {
            return {
                form: new Form({
                    'payment_date': new Date(),
                }, {notify: false}),
                selected: true
            }
        },

        props: ['employees'],

        mounted(){
            this.checkboxAllChanged();
        },

        computed: {
            hasEmployees() {
                return this.employees && this.employees.length > 0 ? true : false;
            },

            selectedEmployees() {
                return this.$children.filter(item => {
                    return item.selected;
                });
                this.hasEmployeesSelected = filtered.length > 0 ? true : false;
                return filtered;
            }
        },

        components: {
            'payroll-line': payrollLineComponent,

            datepicker: require('vuejs-datepicker')
        },

        methods: {   
            closePayroll() {
                return console.log("Close Payroll")
                this.form.post('/admin/payrolls/generate/filter')
                    .then(response => {
                        let data = {
                            employees: response
                        }
                        this.$emit('payroll-generated', data);
                    });
            },
            checkboxAllChanged() {
                Event.fire('checkbox-all-changed', this.selected);
            }
        }
    };
</script>

<style lang="css" scoped>
</style>