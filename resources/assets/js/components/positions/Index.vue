<template>
    <div>
        <modal v-model="editMode">
            <div slot="title">
                <h3>Edit Position {{ current.name_and_department }}</h3>
            </div>
            
            
            <form method="POST" role="form">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input 
                                type="text" class="form-control" id="name" name="name"
                                v-model="editForm.name" required
                            >
                            <span class="help-text text-danger" v-if="formErrors['name']" v-text="formErrors['name'][0]" ></span>
                        </div>
                    </div> 
                    <!-- /..Name -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="department">Department</label>
                            <select class="form-control" id="department" name="department" v-model="editForm.department_id" required>
                                <option :value="department.id" v-for="department in current.departments_list" :key="department.id">
                                    {{ department.department }}
                                </option>
                            </select>
                            <span class="help-text text-danger" v-if="formErrors['department_id']" v-text="formErrors['department_id'][0]" ></span>
                        </div>
                    </div> 
                    <!-- /..Department -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="department">Payment Frequency:</label>
                            <select class="form-control" id="payment_frequency" name="payment_frequency" v-model="editForm.payment_frequency_id" required>
                                <option :value="payment_frequency.id"
                                    v-for="payment_frequency in current.payment_frequencies_list" 
                                    :key="payment_frequency.id"
                                >
                                    {{ payment_frequency.name }}
                                </option>
                            </select>
                            <span class="help-text text-danger" v-if="formErrors['payment_frequency_id']" v-text="formErrors['payment_frequency_id'][0]" ></span>
                        </div>
                    </div> 
                    <!-- /..Payment Frequency: -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="department">Payment Type:</label>
                            <select class="form-control" id="payment_type" name="payment_type" v-model="editForm.payment_type_id" required>
                                <option :value="payment_type.id" v-for="payment_type in current.payment_types_list" :key="payment_type.id">{{ payment_type.name }}</option>
                            </select>
                            <span class="help-text text-danger" v-if="formErrors['payment_type_id']" v-text="formErrors['payment_type_id'][0]" ></span>
                        </div>
                    </div> 
                    <!-- /..Payment Type: -->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="salary">Salary $:</label>
                            <input 
                                type="number" min="0" class="form-control" id="salary" name="salary"
                                v-model="editForm.salary" required
                            >
                            <span class="help-text text-danger" v-if="formErrors['salary']" v-text="formErrors['salary'][0]" ></span>
                        </div>
                    </div> 
                    <!-- /..Salary $: -->
                </div>    
            </form>
            
            <div slot="footer">
                <btn @click="editMode=false">Cancel</btn>
                <btn type="warning" @click="updatePosition(current)">Edit Position</btn>
            </div>
        </modal>

        <table class="table table-condensed table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Frequency</th>
                    <th>Salary</th>
                    <th>
                        <router-link to="/positions/create"><i class="fa fa-plus"></i> Add</router-link>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="position in positions" :key="position.id">
                    <td><span class="badge bg-green">{{ position.employees_count }}</span>{{ position.name_and_department }}</td>
                    <td>{{ position.payment_type.name }}</td>
                    <td>{{ position.payment_frequency.name }}</td>
                    <td>${{ position.salary }}</td>
                    <td>
                        <a href="#" @click.prevent="editPosition(position)" class="text-warning">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination v-model="paginate.current" :total-page="paginate.totalPages" :boundary-links="true" @change="getData(paginate.current)"></pagination>
    </div>    
</template>

<script>
    import {Modal, Btn, Notification, Pagination} from 'uiv'
    import {API} from './../../utilities/config'
    export default {
        name: "PositionsIndex",
        data() {
            return {
                positions: [],
                paginate: {
                    totalPages: 0,
                    current: 0
                },
                editMode: false,
                current: {},
                formErrors: {},
                editForm: {
                    name: '',
                    department_id: '',
                    payment_type_id: '',
                    payment_frequency_id: '',
                    salary: ''
                }
            }
        },
        components: {
            Modal, Btn, Pagination
        },
        created() {
            this.getData() 
        },
        methods: {
            getData(page = 1) {
                console.log(page)
                axios.get(API +'/positions?page=' + page)
                .then(response => {
                    this.positions = response.data.data
                    this.paginate = {
                        totalPages: response.data.last_page,
                        current: response.data.current_page
                    }
                })
                .catch(errors => console.log(errors))
            },
            editPosition(position) {
                this.editMode = true
                this.current = position
                this.editForm = {
                    name: position.name,
                    department_id: position.department_id,
                    payment_type_id: position.payment_type_id,
                    payment_frequency_id: position.payment_frequency_id,
                    salary: position.salary
                }
            },
            updatePosition(position) {
                this.editMode = false
                axios.put(API + '/positions/' + position.id, this.editForm)
                    .then(response => {                        
                        let index = this.positions.findIndex(function(item) {
                            return item.id == position.id
                        })
                        this.positions[index] = Object.assign(this.positions[index], response.data)   
                        Notification.notify({
                            type: 'success',
                            placement: 'bottom-right',
                            title: 'Well done!',
                            content: 'Position Updated.'
                        })
                        this.formErrors = {}
                    })
                    .catch(error => {
                        this.formErrors = error.response.data.errors
                        this.editMode = true
                    })
            }
        }
    }
</script>

<style lang="css" scoped>

</style>