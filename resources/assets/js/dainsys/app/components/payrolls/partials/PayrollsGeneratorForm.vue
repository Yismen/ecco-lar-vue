<template>
    <div class="_PayrollsGeneratorForm">
        
            <div class="col-sm-10 col-sm-offset-1">
                <div class="box box-primary">
                    <div class="box-body">

                        <form @submit.prevent="generatePayroll" class="" 
                            @keydown="form.error.clear($event.target.name)" role="form">

                            <div class="row">

                                <div class="form-group col-sm-3" :class="{'has-error': form.error.has('department')}">
                                    <label for="department" class="">Project:</label>
                                    <select name="department" id="department" class="form-control"  v-model="form.fields.department" @change="filterPositionsByDepartment">
                                        <option v-for="dep in departments" :value="dep.id" selected="selectedItem">{{ dep.department }}</option>
                                    </select>
                                    <span class="text-danger" v-show="form.error.has('department')">{{ form.error.get('department') }}</span>
                                </div>
                                <!-- /. Project -->

                                <div class="form-group col-sm-3" :class="{'has-error': form.error.has('position')}">
                                    <label for="position" class="">Position:</label>
                                    <select name="position" id="position" class="form-control"  v-model="form.fields.position">
                                        <option v-for="position in positions" :value="position.id" :selected="2">{{ position.name_and_department }}</option>
                                    </select>
                                    <span class="text-danger" v-show="form.error.has('position')">{{ form.error.get('position') }}</span>
                                </div>
                                <!-- /. Position -->   

                                 <div class="form-group col-sm-3" :class="{'has-error': form.error.has('payment_type')}">
                                    <label for="payment_type" class="">Payment Type:</label>
                                    <select name="payment_type" id="payment_type" class="form-control"  v-model="form.fields.payment_type">
                                        <option v-for="payment_type in payment_types" :value="payment_type.id">{{ payment_type.name }}</option>
                                    </select>
                                    <span class="text-danger" v-show="form.error.has('payment_type')">{{ form.error.get('payment_type') }}</span>
                                </div>
                                <!-- /. Payment Type -->   
                                
                                <div class="form-group col-sm-3" :class="{'has-error': form.error.has('payment_frequency')}">
                                    <label for="payment_frequency" class="">Payment Fequency:</label>
                                    <select name="payment_frequency" id="payment_frequency" class="form-control"  v-model="form.fields.payment_frequency">
                                        <option v-for="payment_frequency in payment_frequencies" :value="payment_frequency.id">{{ payment_frequency.name }}</option>
                                    </select>
                                    <span class="text-danger" v-show="form.error.has('payment_frequency')">{{ form.error.get('payment_frequency') }}</span>
                                </div>
                                <!-- /. Payment Fequency -->   
                            </div>

                            <div class="row">
                                
                            </div>
                            
                            <div class="row">

                                <div class="form-group col-sm-4" :class="{'has-error': form.error.has('from')}">
                                    <label for="from" class="">From Date:</label>

                                    <datepicker input-class="form-control" 
                                        v-model="form.fields.from" 
                                        name="from" 
                                        id="from"
                                        format="MM/dd/yyyy" 
                                        placeholder="From Date"
                                        :bootstrapStyling="true"
                                        :calendarButton="true"
                                        calendarButtonIcon="fa fa-calendar"
                                        :clearButton="true"
                                    ></datepicker>
                                    <span class="text-danger" v-show="form.error.has('from')">{{ form.error.get('from') }}</span>
                                </div>
                                <!-- /. From Date -->

                                <div class="form-group col-sm-4" :class="{'has-error': form.error.has('to')}">
                                    <label for="to" class="">To Date:</label>
                                    <datepicker input-class="form-control" 
                                        v-model="form.fields.to" 
                                        name="to" 
                                        id="to"
                                        format="MM/dd/yyyy" 
                                        placeholder="To Date"
                                        :bootstrapStyling="true"
                                        :calendarButton="true"
                                        calendarButtonIcon="fa fa-calendar"
                                        :clearButton="true"
                                    ></datepicker>
                                    <span class="text-danger" v-show="form.error.has('to')">{{ form.error.get('to') }}</span>
                                </div>
                                <!-- /. To Date -->
                                
                                                              

                                <div class="form-group col-sm-4">
                                    <button type="submit" class="btn btn-primary form-control">FILTER</button>
                                    <br>
                                </div>

                            </div>

                                

                        </form>
                    </div>
                </div>
            </div>
                        
    </div>
</template>

<script>
    import Form from '../../../../vendor/dainsys-form';
    
    import moment from 'moment'

    export default {

        name: 'PayrollsGeneratorForm',

        data () {
            return {
                form: new Form({
                    'from': new Date(),
                    'to': new Date(),
                    'department': '',
                    'position': '',
                    'payment_type': '',
                    'payment_frequency': '',
                }, {notify: false}),
                departments: [],
                positions: [],
                payment_types: [],
                payment_frequencies: []
            };
        },

        computed: {
            selectedItem() {
                return 2;
            }
        },

        components: {
            datepicker: require('vuejs-datepicker')
        },

        methods: {

            filterPositionsByDepartment() {
                if (this.form.fields.department) {
                    this.form.post('/admin/payrolls/filter-positions-by-department')
                        .then(response => {
                            this.positions = response;
                            this.positions.unshift({name_and_department: '---All---', id: '%'});
                            this.form.fields.position = '%'
                        });
                }
            },

            prepare() {
                this.form.get('/admin/payrolls/prepare')
                    .then(response => {
                        this.departments = response.departments;
                        this.positions = response.positions;
                        this.payment_types = response.payment_types;
                        this.payment_frequencies = response.payment_frequencies;

                        this.payment_types.unshift({name: '---All---', id: '%'});
                        this.form.fields.payment_type = '%'

                        this.payment_frequencies.unshift({name: '---All---', id: '%'});
                        this.form.fields.payment_frequency = '%'

                        this.departments.unshift({department: '---All---', id: '%'});
                        this.form.fields.department = '%'
                            
                        this.positions.unshift({name_and_department: '---All---', id: '%'});
                        this.form.fields.position = '%'
                    });
            },

            generatePayroll() {
                this.form.post('/admin/payrolls/generate/filter')
                    .then(response => {
                        let data = {
                            employees: response
                        }
                        this.$emit('payroll-generated', data);
                    });
            }
        },

        mounted() {
            document.getElementById('department').focus();
            // PayrollStore.modules.PayrollStore.commit('updatePaymentDate')
            this.prepare();
        }
    };
</script>

<style lang="css" scoped>
</style>