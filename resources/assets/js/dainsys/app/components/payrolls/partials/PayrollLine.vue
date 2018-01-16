<template>
    <tr class="_PayrollLine" :class="{success: selected}">
        <th>
            <div class="checkbox">
                <label>
                    <input type="checkbox" v-model="selected">
                    {{ employee.id }}
                </label>
            </div>
        </th>
        <th v-text="employee.full_name"></th>
        <td v-text="employee.position.name_and_department"></td>
        <td>{{ employee.position.payment_type.name }}, {{ employee.position.payment_frequency.name }}</td>
        <td>{{ payPerHours | currency }}</td>
        
        <td title="TSS Amount" class="info">{{ tssAmount  | currency }}</td>
        <td title="Gross Amount" class="info">{{ grossAmount  | currency }}</td>
        <td title="Net Amount" class="info">{{ netAmount  | currency }}</td>
        <td title="Payment Amount" class="info">{{ paymentAmount  | currency }}</td>

        <td :title="'Total Regular Hours = ' + hours.regular">{{ salary.regular | currency }}</td>
        <td :title="'Total Nighly Hours = ' + hours.nightly">{{ nightlySalary | currency }}</td>
        <td :title="'Total Overtime Hours = ' + hours.overtime">{{ overtimeSalary | currency }}</td>
        <td :title="'Total Holiday Hours = ' + hours.holiday">{{ holidaySalary | currency }}</td>
        <td :title="'Total Training Hours = ' + hours.training">{{ trainingSalary | currency }}</td>

        <td title="Incentives">{{ other_incomes.incentives | currency }}</td>
        <td title="Additionals">{{ other_incomes.additionals | currency }}</td>

        <td :title="'ARS Discount = ' + salary.regular + ' * ' + rates.ars" class="danger">{{ arsDiscount  | currency }}</td>
        <td :title="'AFP Discount = ' + salary.regular + ' * ' + rates.afp" class="danger">{{ afpDiscount  | currency }}</td>
        <td title="Other Discounts" class="danger">{{ discounts.others  | currency }}</td>
    </tr>
</template>

<script>
    import Eventing from './../../../../vendor/dainsys-event';
    
    export default {

        name: 'PayollLine',

        data () {
            return {
                selected: false,
                rates: {
                    nightly: 0.15,
                    overtime: 0.35,
                    holiday: 2,
                    training: 0.5,
                    afp: 0.0287,
                    ars: 0.0304,
                    tss_salary: 54.3
                }, 

                identity: this.employee,

                salary: {
                    minimum: 4185,
                    tss: 0,
                    gross: 0,
                    net: 0,
                    payment: 0,

                    regular: 0,
                    nightly: 0,
                    overtime: 0,
                    holiday: 0,
                    training: 0,
                },

                other_incomes: {
                    incentives: 0,
                    additionals: 0
                },

                discounts: {
                    afp: 0,
                    ars: 0,
                    others: 0,
                },

                hours: {
                    regular: 0,
                    nightly: 0,
                    overtime: 0,
                    holiday: 0,
                    training: 0,
                }
            }
        },

        props: ['employee'],

        watch: {
            employee(employee, oldEmployee) {
                console.log(employee, oldEmployee, "changed");
                this.calculateAll();
            }
        },

        mounted() { 
            this.eventListeners(); 

            this.calculateAll();

        },

        computed: {            
            regularSalary() {
                return this.salary.regular;
            },

            nightlySalary() {
                return this.salary.nightly;
            },

            overtimeSalary() {
                return this.salary.overtime;
            },

            holidaySalary() {
                return this.salary.holiday;
            },

            trainingSalary() {
                return this.salary.training;
            },

            payPerHours() {
                return this.salary.pay_per_hours = this.employee.position.pay_per_hours;
            },

            arsDiscount() {
                return this.discounts.ars = this.salary.regular * this.rates.ars;
            },

            afpDiscount() {
                return  this.discounts.afp = this.salary.regular * this.rates.afp;
            },

            tssAmount() {
                return this.salary.tss = this.salary.regular + this.other_incomes.additionals;
            },

            grossAmount() {
                return this.salary.gross = this.salary.regular + 
                    this.salary.nightly +
                    this.salary.overtime +
                    this.salary.holiday +
                    this.salary.training  +
                    this.other_incomes.incentives +
                    this.other_incomes.additionals;
            },

            netAmount() {
                return this.salary.net = this.grossAmount -
                    this.discounts.ars -
                    this.discounts.afp -
                    this.discounts.others;
            },

            paymentAmount() {
                return this.salary.payment = 0;
            }
        },

        methods: {
            calculateAll()
            {
                this.getSumOfHours(this.employee.hours);
                this.getHourlySalaries(this.employee.position.pay_per_hours);  
                this.getIncentives(this.employee.payroll_incentives);
                this.getAdditionals(this.employee.payroll_additionals);
                this.getOtherDiscounts(this.employee.payroll_discounts);
            },

            eventListeners() {
                let vm = this;
                Eventing.listen('checkbox-all-changed',  function(data) {
                    return vm.selected = data;
                });
            },

            getHourlySalaries(pay_per_hours) {
                this.salary.regular = this.hours.regular * pay_per_hours;
                this.salary.nightly = this.hours.nightly * pay_per_hours * this.rates.nightly;
                this.salary.overtime = this.hours.overtime * pay_per_hours * this.rates.overtime;
                this.salary.holiday = this.hours.holiday * pay_per_hours * this.rates.holiday;
                this.salary.training = this.hours.training * pay_per_hours * this.rates.training;
            },

            getOtherDiscounts(others) {
                this.discounts.others = 0;
                let vm = this;
                return others.forEach(function(item, index) {
                    vm.discounts.others = vm.discounts.others + item.discount_amount;
                })
            },

            getAdditionals(additionals) {
                this.other_incomes.additionals = 0;
                let vm = this;
                return additionals.forEach(function(item, index) {
                    vm.other_incomes.additionals = vm.other_incomes.additionals + item.additional_amount;
                })
            },

            getIncentives(incentives) {
                this.other_incomes.incentives = 0;
                let vm = this;
                return incentives.forEach(function(item, index) {
                    vm.other_incomes.incentives = vm.other_incomes.incentives + item.incentive_amount;
                })
            },

            getSumOfHours(hours) {
                this.hours.regular = 0;
                this.hours.nightly = 0;
                this.hours.overtime = 0;
                this.hours.holiday = 0;
                this.hours.training = 0;
                let vm = this;

                return hours.forEach(function(item, index) {
                    vm.hours.regular = vm.hours.regular + item.regulars;
                    vm.hours.nightly = vm.hours.nightly + item.nightly;
                    vm.hours.overtime = vm.hours.overtime + item.overtime;
                    vm.hours.holiday = vm.hours.holiday + item.holidays;
                    vm.hours.training = vm.hours.training + item.training;
                })
            }
        }
    };
</script>

<style lang="css" scoped>
</style>