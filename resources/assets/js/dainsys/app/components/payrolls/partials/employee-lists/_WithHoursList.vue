<template>
    <div class="_WithHoursList">
        <div class="col-sm-12" v-if="isGenerated">
            <div class="box" :class="[hasEmployees ? 'box-info' : 'box-danger']" >
                <div class="box-body">
                    <div class="table-responsive">
                        <div class="box-header">
                            <div class="col-sm-4"><h3>Employees With Hours <span class="badge bg-light-blue">{{ employeesCount }}</span></h3></div>
                            
                            <div class="col-sm-8">
                                <div class="col-lg-2">Selected <span class="badge bg-red" :class="{'bg-green': hasEmployeesSelected}">{{ selectedEmployees.length }}</span></div>
                                
                                <form role="form" 
                                    class="form-horizontal col-lg-10" 
                                    v-if="hasEmployeesSelected" 
                                    @keydown="form.error.clear($event.target.name)"
                                    @submit.prevent="closePayroll">

                                    <div class="form-group">
                                        <label for="date" class="label-control col-sm-2 hidden-xs">Date:</label>
                                        <div class="col-sm-10">
                                            <div class="col-sm-8">
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
                                            <button type="submit" class="btn btn-warning col-sm-4">Close Payroll</button>
                                        </div>
                                            
                                    </div>                    
                                </form>
                            </div>

                        </div>
                        <div class="box-body">
                            <table class="table table-striped table-condensed table-bordered" v-if="hasEmployees">
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
                                        <th>Payment Per Hours</th>
                                        
                                        <th>TSS Amount</th>
                                        <th>Gross Amount</th>
                                        <th>Net Amount</th>
                                        <th>Payment Amount</th>

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
                                    </tr>
                                </thead>
                                <tbody>
                                    <payroll-line v-for="employee in employees" :key="employee.id" :employee="employee"></payroll-line>                        
                                </tbody>
                            </table>

                            <div class="alert alert-danger" v-else>
                                <strong>Crap!</strong> I dont have any employee to show you with these criterias. Please redifine your search.
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import payrollLineComponent from './../PayrollLine';

    export default {

        name: 'WithHoursList',

        data() {
            return {
                selected: false,
                form: new (this.$ioc.resolve('Form'))({
                    from_date: '',
                    to_date: '',
                    payment_date: new Date(new Date().setUTCHours(-3)),
                    activeEmployees: []
                }, {notify: false}),
                children: [],
                event: this.$ioc.resolve('Event')
            }
        },

        mounted() {
            this.checkboxAllChanged();
            
            this.assignChildren();
        },

        computed: {
            isGenerated(){
                return this.$store.state.PayrollStore.generated;
            },
            employees() {
                return this.$store.getters.allEmployees;
            },
            employeesCount() {
                return this.employees.length;
            },
            fromDate() {
                return this.$store.getters.fromDate;
            },
            toDate() {
                return this.$store.getters.toDate;
            },
            childrenEmployees() {
                return this.children.map(function(item, index){
                    return {
                        selected: item.selected,
                        data: {
                            identity: item.identity,
                            salary: item.salary,
                            other_incomes: item.other_incomes,
                            discounts: item.discounts,
                        }
                    }
                });
            },

            hasEmployees() {
                return this.employees && this.employees.length > 0 ? true : false;
            },

            selectedEmployees() {
                return this.form.fields.activeEmployees = this.childrenEmployees.filter(item => {
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
                return this.children = this.$children;
            
            },

            closePayroll() {
                this.form.fields.from_date = this.fromDate;
                this.form.fields.to_date = this.toDate;

                this.form.post('/admin/payrolls/close')
                    .then(response => {
                        console.log("Alert payroll was close", "Take other actions", response)
                    });


            },

            checkboxAllChanged() {
                this.event.fire('checkbox-all-changed', this.selected);
            }
        }
    };
</script>

<style lang="css" scoped>
</style>