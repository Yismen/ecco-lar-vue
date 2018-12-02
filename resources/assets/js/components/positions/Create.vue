<template>
    <div>

        <modal :show="createDepartmentModal"
            @modal-hidden="createDepartmentModal = false"
            @modal-submitted="createDepartment()"
        >
            <h4 slot="modal-title">Create Department</h4>

            <div class="form-group">
                <label for="inputdepartment" class="col-sm-2 control-label">Department:</label>
                <div class="col-sm-10">
                    <input type="text" name="department" id="inputdepartment" class="form-control" v-model="department_form.department" required="required">
                    <span class="help-text text-danger" v-if="errors['department']">{{ errors['department'][0] }}</span>
                </div>
            </div>

        </modal>

        <modal :show="createPFrequencyModal"
            @modal-hidden="createPFrequencyModal = false"
            @modal-submitted="createPFrequency()"
        >
            <h4 slot="modal-title">Create Paymen Frequency</h4>

            <div class="form-group">
                <label for="inputfrequency" class="col-sm-2 control-label">Frequency:</label>
                <div class="col-sm-10">
                    <input type="text" name="frequency" id="inputfrequency" class="form-control" v-model="pfrequency_form.name" required="required">
                    <span class="help-text text-danger" v-if="errors['frequency']">{{ errors['frequency'][0] }}</span>
                </div>
            </div>
        </modal>

        <modal :show="createPTypeModal"
            @modal-hidden="createPTypeModal = false"
            @modal-submitted="createPType()"
        >
            <h3>Create Type</h3>
        </modal>


        <form action=""  class="form-horizontal" role="form" @submit.prevent="submitForm">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="input" class="col-sm-2 control-label">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" required class="form-control" v-model="form.name"  title="Position Name">
                            <span class="help-text text-danger" v-if="errors['name']">{{ errors['name'][0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="input" class="col-sm-3 control-label">Department:</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <select required class="form-control"  v-model="form.department_id">
                                    <option v-for="(department, index) in departments" :key="index" :value="department.id">{{ department.department }}</option>
                                </select>
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary" @click="createDepartmentModal = true" title="Add Department">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <span class="help-text text-danger" v-if="errors['department_id']">{{ errors['department_id'][0] }}</span>
                        </div>
                    </div>
                </div>
                <!-- /. Department -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="input" class="col-sm-3 control-label">Payment Frequency:</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <select required class="form-control"  v-model="form.payment_frequency_id">
                                    <option v-for="(frequency, index) in frequencies" :key="index" :value="frequency.id">{{ frequency.name }}</option>
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary" @click="createPFrequencyModal = true" title="Add Payment Frequency">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </span>
                            </div>
                            <span class="help-text text-danger" v-if="errors['payment_frequency_id']">{{ errors['payment_frequency_id'][0] }}</span>

                        </div>
                    </div>
                </div>
                <!-- /. Payment Frequency -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="input" class="col-sm-3 control-label">Payment Type:</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <select class="form-control" required v-model="form.payment_type_id">
                                    <option v-for="(type, index) in payment_types" :key="index" :value="type.id">{{ type.name }}</option>
                                </select>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary" @click="createPTypeModal = true" title="Add Payment Type">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </span>
                            </div>
                            <span class="help-text text-danger" v-if="errors['payment_type_id']">{{ errors['payment_type_id'][0] }}</span>
                        </div>
                    </div>
                </div>
                <!-- ./ Payment Type -->
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="input" class="col-sm-2 control-label">Salary:</label>
                        <div class="col-sm-10">
                            <input type="number" min="50" required class="form-control" v-model="form.salary"  title="Position Name">
                            <span class="help-text text-danger" v-if="errors['salary']">{{ errors['salary'][0] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./ Salary -->
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>


    </div>
</template>

<script>
    import {API} from '../../config/config'
    import Modal from '../Modal'
    export default {
        name: "Create",
        data() {
            return {
                createDepartmentModal: false,
                createPFrequencyModal: false,
                createPTypeModal: false,
                form: {
                    name: '',
                    department_id: '',
                    payment_frequency_id: '',
                    payment_type_id: '',
                    salary: ''
                },
                department_form: {
                    department: ''
                },
                pfrequency_form: {
                    name: ''
                },
                errors: [],
                departments: [],
                frequencies: [],
                payment_types: []
            }
        },
        components: {
            Modal
        },
        created() {
            axios.get(API + '/positions/create')
                .then(response => {
                    this.departments = response.data.departments_list
                    this.frequencies = response.data.payment_frequencies_list
                    this.payment_types = response.data.payment_types_list
                })
        },
        methods: {
            resetForm() {
                this.form = {
                    name: '',
                    department_id: '',
                    payment_frequency_id: '',
                    payment_type_id: '',
                    salary: ''
                },
                this.errors = []
            },
            submitForm() {
                axios.post('/api/positions', this.form)
                    .then(response => {
                        this.$router.push("/")
                    })
                    .catch(error => this.errors = error.response.data.errors)
            },
            createDepartment() {
                axios.post(API + '/departments', this.department_form)
                    .then(response => {
                        this.department_form = {department: ''}
                        this.departments.push(response.data)
                        this.createDepartmentModal = false
                        this.errors = []
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors
                        this.createDepartmentModal = true
                    })

            },
            createPFrequency() {
                axios.post(API + '/payment_frequencies', this.pfrequency_form)
                    .then(response => {
                        this.pfrequency_form = {name: ''}
                        this.frequencies.push(response.data)
                        this.createPFrequencyModal = false
                        this.errors = []
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors
                        this.createPFrequencyModal = true
                    })
            },
            createPType() {
                console.log("Please create type")
                this.createPTyeModal = false
            }
        }
    }
</script>

<style lang="css" scoped>

</style>