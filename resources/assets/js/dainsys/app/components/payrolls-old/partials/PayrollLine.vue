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

        <td :title="'Total Regular Hours = ' + hours.regulars">{{ regularSalary | currency }}</td>
        <td :title="'Total Nighly Hours = ' + hours.nightly">{{ nightlySalary | currency }}</td>
        <td :title="'Total Overtime Hours = ' + hours.overtime">{{ overtimeSalary | currency }}</td>
        <td :title="'Total Holiday Hours = ' + hours.holidays">{{ holidaySalary | currency }}</td>
        <td :title="'Total Training Hours = ' + hours.training">{{ trainingSalary | currency }}</td>

        <td title="Incentives">{{ incomes.incentives | currency }}</td>
        <td title="Additionals">{{ incomes.additionals | currency }}</td>

        <td title="ARS Discount" class="danger">{{ arsDiscount  | currency }}</td>
        <td title="AFP Discount" class="danger">{{ afpDiscount  | currency }}</td>
        <td title="Other Discounts" class="danger">{{ discounts.others  | currency }}</td>
        
        <td title="TSS Amount" class="info">{{ tssAmount  | currency }}</td>
        <td title="Gross Amount" class="info">{{ grossAmount  | currency }}</td>
        <td title="Net Amount" class="info">{{ netAmount  | currency }}</td>
        <td title="Payment Amount" class="info">{{ paymentAmount  | currency }}</td>
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
                    holidays: 2,
                    training: 0.5,
                    afp: 0.0287,
                    ars: 0.0304,
                    tss_salary: 54.3
                }, 

                salaries: {
                    minimum: 4185,
                    tss: 0,
                    gross: 0,
                    net: 0,
                    payment: 0,

                    regulars: 0,
                    nightly: 0,
                    overtime: 0,
                    holidays: 0,
                    training: 0,
                },

                incomes: {
                    incentives: 0,
                    additionals: 0
                },

                discounts: {
                    afp: 0,
                    ars: 0,
                    others: 0,
                },

                hours: {
                    regulars: 0,
                    nightly: 0,
                    overtime: 0,
                    holidays: 0,
                    training: 0,
                }
            }
        },

        props: ['employee'],

        mounted() { 
            this.eventListeners(); 

            this.getSumOfHours(this.employee.hours);

            this.getHourlySalaries(this.employee.position.pay_per_hours);

            this.getIncentives(this.employee.payroll_incentives);

            this.getAdditionals(this.employee.payroll_additionals);

            this.getOtherDiscounts(this.employee.payroll_discounts);


        },

        computed: {
            uniqueId() {
                return this.employee.employee_id + '-';
            },
            
            regularSalary() {
                return this.salaries.regulars;
            },

            nightlySalary() {
                return this.salaries.nightly;
            },

            overtimeSalary() {
                return this.salaries.overtime;
            },

            holidaySalary() {
                return this.salaries.holidays;
            },

            trainingSalary() {
                return this.salaries.training;
            },

            payPerHours() {
                return this.employee.position.pay_per_hours;
            },

            arsDiscount() {
                return this.salaries.regulars * this.rates.ars;
            },

            afpDiscount() {
                return this.salaries.regulars * this.rates.afp;
            },

            tssAmount() {
                return this.salaries.regulars;
            },

            grossAmount() {
                return this.salaries.regulars + this.incomes.additionals;
            },

            netAmount() {
                return this.salaries.regulars + 
                    this.salaries.mightly +
                    this.salaries.overtime +
                    this.salaries.holidays +
                    this.salaries.training 
                    +
                    this.incomes.incentives +
                    this.incomes.additionals
                    -
                    this.discounts.ars -
                    this.discounts.afp -
                    this.discounts.others;
            },

            paymentAmount() {
                return this.salaries.regulars + 
                    this.salaries.mightly +
                    this.salaries.overtime +
                    this.salaries.holidays +
                    this.salaries.training 
                    -
                    this.discounts.ars -
                    this.discounts.afp -
                    this.discounts.others;
            }
        },

        methods: {

            eventListeners() {
                let vm = this;
                Eventing.listen('checkbox-all-changed',  function(data) {
                    return vm.selected = data;
                });
            },

            getHourlySalaries(pay_per_hours) {
                this.salaries.regulars = this.hours.regulars * pay_per_hours;
                this.salaries.nightly = this.hours.nightly * pay_per_hours * this.rates.nightly;
                this.salaries.overtime = this.hours.overtime * pay_per_hours * this.rates.overtime;
                this.salaries.holiday = this.hours.holiday * pay_per_hours * this.rates.holiday;
                this.salaries.training = this.hours.training * pay_per_hours * this.rates.training;
            },
            getOtherDiscounts(others) {
                this.discounts.others = 0;
                let vm = this;
                return others.forEach(function(item, index) {
                    vm.discounts.others = vm.discounts.others + item.discount_amount;
                })
            },
            getAdditionals(additionals) {
                this.incomes.additionals = 0;
                let vm = this;
                return additionals.forEach(function(item, index) {
                    vm.incomes.additionals = vm.incomes.additionals + item.additional_amount;
                })
            },

            getIncentives(incentives) {
                this.incomes.incentives = 0;
                let vm = this;
                return incentives.forEach(function(item, index) {
                    vm.incomes.incentives = vm.incomes.incentives + item.incentive_amount;
                })
            },

            getSumOfHours(hours) {
                this.hours.regulars = 0;
                this.hours.nightly = 0;
                this.hours.overtime = 0;
                this.hours.holidays = 0;
                this.hours.training = 0;
                let vm = this;

                return hours.forEach(function(item, index) {
                    vm.hours.regulars = vm.hours.regulars + item.regulars;
                    vm.hours.nightly = vm.hours.nightly + item.nightly;
                    vm.hours.overtime = vm.hours.overtime + item.overtime;
                    vm.hours.holidays = vm.hours.holidays + item.holidays;
                    vm.hours.training = vm.hours.training + item.training;
                })
            }
        }
    };
</script>

<style lang="css" scoped>
</style>