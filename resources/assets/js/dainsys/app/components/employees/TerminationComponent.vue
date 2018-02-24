<template>
    <div class="_Termination" >
        <form class="" role="form"
            @submit.prevent="submitTermination"
            autocomplete="off" 
            @change="updated">

            <div class="box-header with-border bg-yellow" :class="{'bg-green': isActive}">
                <h4>{{ employee.full_name }}' Termination. Current Status is {{ employee.status }}</h4>
            </div>
    
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="input" class="">Termination Date:</label>
                            <div class="">
                                <datepicker input-class="form-control input-sm" 
                                    v-model="form.fields.termination_date" 
                                    name="termination_date" 
                                    format="MM/dd/yyyy" 
                                ></datepicker>
                                <span class="text-danger" v-if="form.error.has('termination_date')">{{ form.error.get('termination_date') }}</span>
                            </div>
                        </div> <!-- ./Termination Date-->
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="input" class="">Termination Type:</label>
                            <div class="">
                                <select name="termination_type_id" id="termination_type_id" class="form-control" v-model="form.fields.termination_type_id">
                                    <option v-for="(termination_type_id, index) in employee.termination_type_list" :value="index" :key="termination_type_id">{{ termination_type_id }}</option>
                                </select>
                                <span class="text-danger" v-if="form.error.has('termination_type_id')">{{ form.error.get('termination_type_id') }}</span>
                            </div>
                        </div> <!-- ./Termination Type-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="input" class="">Termination Reason:</label>
                            <div class="">
                                <select name="termination_reason_id" id="termination_reason_id" class="form-control" 
                                    v-model="form.fields.termination_reason_id">
                                    <option v-for="(termination_reason_id, index) in employee.termination_reason_list" :value="index" :key="termination_reason_id">{{ termination_reason_id }}</option>
                                </select>
                                <span class="text-danger" v-if="form.error.has('termination_reason_id')">{{ form.error.get('termination_reason_id') }}</span>
                            </div>
                        </div> <!-- ./Termination Reason-->
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="input" class="">Can be Re-hired?:</label>
                            <div class="">
                                <div class="radio">
                                    <label class="text-success">
                                        <input type="radio" name="can_be_rehired" id="can_be_rehired_1" v-bind:value="1" v-model="form.fields.can_be_rehired">
                                        Yes, for sure.
                                    </label>
                                    <label class="text-warning">
                                        <input type="radio" name="can_be_rehired" id="can_be_rehired_2" v-bind:value="0" v-model="form.fields.can_be_rehired">
                                        No, don't do it.
                                    </label>
                                </div>
                                <span class="text-danger" v-if="form.error.has('can_be_rehired')">{{ form.error.get('can_be_rehired') }}</span>
                            </div>
                        </div> 
                        <!-- ./Can be Re-hired?-->
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="input" class="">Additional Comments:</label>
                            <div class="">
                                <textarea id="comments" 
                                name="comments" class="form-control" 
                                v-model="form.fields.comments" rows="5"></textarea>
                                <span class="text-danger" v-if="form.error.has('comments')">{{ form.error.get('comments') }}</span>
                            </div>
                        </div> <!-- ./Additional Comments-->
                    </div>
                    
                    <div class="col-sm-6" v-if="showButton">
                        <div class="form-group">
                            <div class=" col-sm-offset-2">
                                <button type="submit" class="btn btn-danger" v-if="isActive">
                                    TERMINATE
                                </button>
                                <button type="submit" class="btn btn-warning" v-else>
                                    UPDATE TERMINATION INFO
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                

            </div>

        </form>

        <div class="row with-border" v-if="! isActive">
            <employee-reactivation :employee="employee" @employee-reactivated="reactivateEmployee"></employee-reactivation>
        </div>
    </div>
</template>

<script>

    import Form from '../../../vendor/jorge.form'
    import EmployeeReactivation from './ReactivationComponent';
    import Datepicker from 'vuejs-datepicker';

    export default {

      name: 'TerminationComponent',

      data () {
        return {
            form: new Form({
                'termination_date': this.employee.termination ? this.employee.termination.termination_date : '',
                'termination_type_id': this.employee.termination ? this.employee.termination.termination_type_id : '',
                'termination_reason_id': this.employee.termination ? this.employee.termination.termination_reason_id : '',
                'can_be_rehired': this.employee.termination ? this.employee.termination.can_be_rehired : '',
                'comments': this.employee.termination ? this.employee.termination.comments : '',
            }, false),
            showButton: false,
            isActive: this.employee.termination ? false : true,
        };
    },

    props: {
        employee: {}
    },

    methods: {
        updated(event) {
            this.showButton = true;
            this.form.error.clear(event.target.name)
        },
        submitTermination() {
            this.form.post('/admin/employees/terminations/' + this.employee.id)
                .then(response => {
                    this.isActive = false;
                    this.showButton = false;
                    this.employee.termination = response.termination;
                    return this.form.fields = response.termination;
                })
        }, 

        reactivateEmployee(response) {
            this.isActive = true;
            this.employee.termination = response.termination;
            return this.form.reset();
        }
    },

    components: {
        EmployeeReactivation, Datepicker
    },
};
</script>

<style lang="css" scoped>
</style>