<template>
    <div class="_Edit">
        <form role="form"
            @submit.prevent="handleEdit"
            autocomplete="off"
            @change="form.error.clear($event.target.name)"
        >

            <div class="box-header with-border">
                <h4>General Information</h4>
            </div>

            <div class="box-body">
                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="first_name" class="">First Name:</label>
                            <input type="text" id="first_name"
                                name="first_name" class="form-control input-sm"
                                v-model="form.fields.first_name"
                            >
                            <span class="text-danger" v-if="form.error.has('first_name')">{{ form.error.get('first_name') }}</span>
                        </div>
                    </div> <!-- ./First Name-->

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="second_first_name" class="">Second First Name:</label>
                            <input type="text" id="second_first_name"
                                name="second_first_name" class="form-control input-sm"
                                v-model="form.fields.second_first_name"
                            >
                            <span class="text-danger" v-if="form.error.has('second_first_name')">{{ form.error.get('second_first_name') }}</span>
                        </div>
                    </div> <!-- ./Second First Name-->

                </div>

                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="last_name" class="">Last Name:</label>
                            <input type="text" id="last_name"
                                name="last_name" class="form-control input-sm"
                                v-model="form.fields.last_name"
                            >
                            <span class="text-danger" v-if="form.error.has('last_name')">{{ form.error.get('last_name') }}</span>
                        </div>
                    </div> <!-- ./Last Name-->

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="second_last_name" class="">Second Last Name:</label>
                            <input type="text" id="second_last_name"
                                name="second_last_name" class="form-control input-sm"
                                v-model="form.fields.second_last_name"
                            >
                            <span class="text-danger" v-if="form.error.has('second_last_name')">{{ form.error.get('second_last_name') }}</span>
                        </div>
                    </div> <!-- ./Second Last Name-->

                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="personal_id" class="">Personal ID:</label>
                            <input type="text" id="personal_id"
                                name="personal_id" class="form-control input-sm"
                                v-model="form.fields.personal_id"
                            >
                            <span class="text-danger" v-if="form.error.has('personal_id')">{{ form.error.get('personal_id') }}</span>
                        </div>
                    </div> <!-- ./Personal ID-->

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="passport" class="">Or Passport:</label>
                            <input type="text" id="passport"
                                name="passport" class="form-control input-sm"
                                v-model="form.fields.passport"
                            >
                            <span class="text-danger" v-if="form.error.has('passport')">{{ form.error.get('passport') }}</span>
                        </div>
                    </div> <!-- ./Or Passport-->
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="hire_date" class="">Hire Date:</label>
                            <date-picker input-class="form-control input-sm"
                                v-model="form.fields.hire_date"
                                name="hire_date"
                                format="MM/dd/yyyy"
                            ></date-picker>
                            <span class="text-danger" v-if="form.error.has('hire_date')">{{ form.error.get('hire_date') }}</span>
                        </div>
                    </div> <!-- ./Hire Date-->

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="date_of_birth" class="">Date of Birth:</label>
                            <date-picker input-class="form-control input-sm"
                                name="date_of_birth"
                                v-model="form.fields.date_of_birth"
                                format="MM/dd/yyyy"
                            ></date-picker>
                            <span class="text-danger" v-if="form.error.has('date_of_birth')">{{ form.error.get('date_of_birth') }}</span>
                        </div>
                    </div> <!-- ./Date of Birth-->
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cellphone_number" class="">Cellphone Number:</label>
                            <input type="text" id="cellphone_number"
                                name="cellphone_number" class="form-control input-sm"
                                v-model="form.fields.cellphone_number"
                            >
                            <span class="text-danger" v-if="form.error.has('cellphone_number')">{{ form.error.get('cellphone_number') }}</span>
                        </div>
                    </div> <!-- ./Cellphone Number-->

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="secondary_phone" class="">Secondary Phone #:</label>
                            <input type="text" id="secondary_phone"
                                name="secondary_phone" class="form-control input-sm"
                                v-model="form.fields.secondary_phone"
                            >
                            <span class="text-danger" v-if="form.error.has('secondary_phone')">{{ form.error.get('secondary_phone') }}</span>
                        </div>
                    </div> <!-- ./Secondary Phone #-->
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="position_id">Position:</label>
                            <div class="input-group">
                                <select class="form-control"
                                    name="position_id"
                                    v-model="form.fields.position_id"
                                >
                                    <option
                                        v-for="position in positions_list"
                                        :key="position.id" :value="position.id"
                                    > {{ position.name_and_department }}, ${{ position.salary }}
                                    </option>
                                </select>
                                <div class="input-group-addon">
                                    <create-position
                                        @position-created="addPosition"
                                        :departments_list="employee.departments_list"
                                        :payment_types_list="employee.payment_types_list"
                                        :payment_frequencies_list="employee.payment_frequencies_list"
                                    ></create-position>
                                </div>

                            </div>
                            <span class="text-danger" v-if="form.error.has('position_id')">{{ form.error.get('position_id') }}</span>

                        </div>
                    </div>
                    <!-- / Position -->

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="gender_id" class="">Gender:</label>
                            <select name="gender_id"
                                id="gender_id"
                                class="form-control"
                                v-model="form.fields.gender_id"
                            >
                                <option v-for="gender in employee.genders_list" :value="gender.id" :key="gender.id">
                                    {{ gender.gender }}
                                </option>
                            </select>
                            <span class="text-danger" v-if="form.error.has('gender_id')">{{ form.error.get('gender_id') }}</span>
                        </div>
                    </div> <!-- ./Gender-->
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="marital_id" class="">Marital Status:</label>
                            <select
                                name="marital_id"
                                id="marital_id"
                                class="form-control"
                                v-model="form.fields.marital_id"
                            >
                                <option v-for="marital in employee.maritals_list"
                                    :value="marital.id" :key="marital.id"
                                >{{ marital.name }}</option>
                            </select>
                            <span class="text-danger" v-if="form.error.has('marital_id')">{{ form.error.get('marital_id') }}</span>
                        </div>
                    </div> <!-- ./Marital Status-->

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="has_kids" class="">Has Kids?:</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" :value="1" v-model="form.fields.has_kids">
                                    Yes
                                </label>
                                <label>
                                    <input type="radio" :value="0" v-model="form.fields.has_kids">
                                    No
                                </label>
                            </div>
                            <span class="text-danger" v-if="form.error.has('has_kids')">{{ form.error.get('has_kids') }}</span>
                        </div>
                    </div> <!-- ./Has Kids-->
                </div>
            </div>

            <div class="box-footer">
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-success">
                            UPDATE
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</template>

<script>
    import DatePicker from './../DatePicker'
    import EmployeeMixins from './Mixins'
    import CreatePosition from '../forms/CreatePosition'

    export default {

      name: 'EditInfoComponent',

      data () {
        return {
            form: new (this.$ioc.resolve('Form')) (this.getEmployeeObject(), false),
            positions_list: []
        };
    },

    mixins: [EmployeeMixins],

    computed: {
        employee() {
            return this.$store.getters['employee/getEmployee']
        }
    },

    components: {DatePicker, CreatePosition},

    mounted() {
        return this.positions_list = this.employee.positions_list
    },

    methods: {
        handleEdit() {
            this.form.put('/admin/employees/' + this.employee.id)
                .then(({data}) => {
                    this.$store.dispatch('employee/set', data)
                    return this.form.fields = this.getEmployeeObject();
                })
        },
        addPosition(position) {
            this.positions_list.unshift(position)
        },
        getEmployeeObject() {
            let employee = this.$store.getters['employee/getEmployee']
            return {
                'first_name': employee.hasOwnProperty('first_name') ? employee.first_name : '',
                'second_first_name': employee.hasOwnProperty('second_first_name') ? employee.second_first_name : '',
                'last_name': employee.hasOwnProperty('second_first_name') ? employee.last_name : '',
                'second_last_name': employee.hasOwnProperty('second_last_name') ? employee.second_last_name : '',
                'personal_id': employee.hasOwnProperty('personal_id') ? employee.personal_id : '',
                'passport': employee.hasOwnProperty('passport') ? employee.passport : '',
                'hire_date': employee.hasOwnProperty('hire_date') ? employee.hire_date : new Date,
                'date_of_birth': employee.hasOwnProperty('date_of_birth') ? employee.date_of_birth : new Date,
                'cellphone_number': employee.hasOwnProperty('cellphone_number') ? employee.cellphone_number : '',
                'secondary_phone': employee.hasOwnProperty('secondary_phone') ? employee.secondary_phone : '',
                'gender_id': employee.hasOwnProperty('gender_id') ? employee.gender_id : '',
                'marital_id': employee.hasOwnProperty('marital_id') ? employee.marital_id : '',
                'has_kids': employee.hasOwnProperty('has_kids') ? Number(employee.has_kids) : '',
                'position_id': employee.hasOwnProperty('position_id') ? employee.position_id : '',
            }
        }
    }
};
</script>

<style lang="css" scoped>
</style>