<template>
    <div class="_WithHoursList">
        <div class="box-body">
            <div class="table-responsive" v-if="hasEmployees">
                <div class="box-header">
                    <h3>
                        <div class="col-sm-3">Employees With Hours</div>
                        <div class="col-sm-3">Selected <span class="badge bg-red" :class="{'bg-green': hasEmployeesSelected}">{{ selectedEmployees.length }}</span></div>
                        <div class="col-sm-6">
                            
                            <form role="form" 
                                class="form-horizontal pull-right" 
                                v-if="hasEmployeesSelected" 
                                @keydown="form.error.clear($event.target.name)"
                                @submit.prevent="closePayrolls">

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
                        </div>
            
                    </h3>

                </div>
                <table class="table table-striped table-condensed table-bordered">
                    <thead>
                        <tr>                        
                            <th>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" v-model="selected" @change="checkboxAllChanged">
                                        <strong>Employee ID (All) </strong>
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

    // import Binder from './../../../../../bootstrap/Binder.js'
    // let Form = new Binder.get('form')

    export default {

        name: 'WithHoursList',

        data() {
            return {
                selected: false,

                form: new Form({
                    payment_date: new Date(),
                    activeEmployees: []
                }, {notify: false}),
                childrenEmployees: []
            }
        },

        props: ['employees'],

        mounted() {
            this.checkboxAllChanged();
            
            this.assignChildren();
        },

        computed: {
            hasEmployees() {
                console.log('emp: ', this)
                return this.employees && this.employees.length > 0 ? true : false;
            },

            selectedEmployees() {
                return this.childrenEmployees.filter(item => {
                    return item.selected;
                });
            },
            
            hasEmployeesSelected() {
                return this.selectedEmployees.length > 0 ? true : false;
            }
        },

        components: {
            'payroll-line': payrollLineComponent,

            datepicker: require('vuejs-datepicker')
        },

        methods: {  
            assignChildren() {
                return console.log(this.employees);
            },

            closePayrolls() {
               let employees = this.selectedEmployees;

                console.log(this.selectedEmployees)

                this.$http.post('/admin/payrolls/close', {
                    payment_date: this.form.payment_date,
                    selected_employees: employees
                }).then(response => {
                    console.log(response)
                })

                // this.form.post('/admin/payrolls/close')
                //     .then(response => {
                //         console.log(response)
                //     })

                // this.form.fields.activeEmployees = [];


            },

            checkboxAllChanged() {
                Event.fire('checkbox-all-changed', this.selected);
            }
        }
    };
</script>

<style lang="css" scoped>
</style>