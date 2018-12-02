<template>
    <div class="_Termination" >

        <div class="box-header with-border bg-yellow" :class="{'bg-green': isActive}">
            <h4>{{ employee.full_name }}' Termination. Current Status is {{ employee.status }}</h4>
        </div>

        <div class="row with-border" v-if="! isActive">
            <employee-reactivation :employee="employee" @employee-reactivated="reactivate"></employee-reactivation>
        </div>

        <form class="" role="form"
            @submit.prevent="terminate"
            autocomplete="off" 
            @change="updated">
    
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">                        
                        <div class="form-group" :class="{'has-error': form.error.has('termination_date')}">
                            <label for="input" class="">Date:</label>
                            <date-picker input-class="form-control input-sm" 
                                v-model="form.fields.termination_date"
                                @updated="terminationDateUpdated"
                            ></date-picker>
                            <span class="text-danger" v-if="form.error.has('termination_date')">{{ form.error.get('termination_date') }}</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group" :class="{'has-error': form.error.has('termination_type_id')}">
                            <label for="input" class="">Termination Type:</label>
                            <div class="">
                                <select name="termination_type_id" id="termination_type_id" class="form-control input-sm" v-model="form.fields.termination_type_id">
                                    <option v-for="(termination_type_id, index) in employee.termination_type_list" :value="index" :key="termination_type_id">{{ termination_type_id }}</option>
                                </select>
                                <span class="text-danger" v-if="form.error.has('termination_type_id')">{{ form.error.get('termination_type_id') }}</span>
                            </div>
                        </div> 
                    </div>
                    <!-- ./Termination Type-->
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group" :class="{'has-error': form.error.has('termination_reason_id')}">
                            <label for="input" class="">Termination Reason:</label>
                            <div class="">
                                <select name="termination_reason_id" id="termination_reason_id" class="form-control input-sm" 
                                    v-model="form.fields.termination_reason_id">
                                    <option v-for="(termination_reason_id, index) in employee.termination_reason_list" :value="index" :key="termination_reason_id">{{ termination_reason_id }}</option>
                                </select>
                                <span class="text-danger" v-if="form.error.has('termination_reason_id')">{{ form.error.get('termination_reason_id') }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- ./Termination Reason-->
                    <div class="col-sm-6">
                        <div class="form-group" :class="{'has-error': form.error.has('can_be_rehired')}">
                            <label for="input" class="">Can be Re-hired?:</label>
                            <div class="pad"
                                 :class="[! form.fields.can_be_rehired ? 'bg-warning' :'bg-success']"
                            >
                                <div class="radio">
                                    <label class="text-success">
                                        <input type="radio" name="can_be_rehired" :value="true" v-model="form.fields.can_be_rehired">
                                        Yes, for sure.
                                    </label>
                                    <label class="text-warning">
                                        <input type="radio" name="can_be_rehired" :value="false" v-model="form.fields.can_be_rehired">
                                        No, don't do it.
                                    </label>
                                </div>
                                <span class="text-danger" v-if="form.error.has('can_be_rehired')">{{ form.error.get('can_be_rehired') }}</span>
                            </div>
                        </div> 
                    </div>
                    <!-- ./Can be Re-hired?-->
                </div>
                
                <div class="row">
                    <div class="col-sm-6" :class="{'has-error': form.error.has('comments')}">
                        <div class="form-group" v-if="reasonIsOther">
                            <label for="input" class="">Comments:</label>
                            <div class="">
                                <textarea id="comments" 
                                name="comments" class="form-control input-sm" 
                                v-model="form.fields.comments" rows="5"></textarea>
                                <span class="text-danger" v-if="form.error.has('comments')">{{ form.error.get('comments') }}</span>
                            </div>
                        </div> <!-- ./Comments-->
                    </div>

                    <div class="col-sm-6">
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
    </div>
</template>

<script>
    import EmployeeReactivation from './ReactivationComponent';
    import DatePicker from './../DatePicker'

    export default {

      name: 'TerminationComponent',

      data () {
        return {
            form: new (this.$ioc.resolve('Form')) ({
                'termination_date': this.employee.termination ? this.employee.termination.termination_date : new Date(),
                'termination_type_id': this.employee.termination ? this.employee.termination.termination_type_id : '',
                'termination_reason_id': this.employee.termination ? this.employee.termination.termination_reason_id : '',
                'can_be_rehired': this.employee.termination ? this.employee.termination.can_be_rehired : true,
                'comments': this.employee.termination ? this.employee.termination.comments : '',
            }, false),
            isActive: this.employee.termination ? false : true
        };
    },

    props: {
        employee: {}
    },

    computed: {
        reasonIsOther() {
            if(this.employee.termination_reason_list[this.form.fields.termination_reason_id] == "Other") {
                return true;
            }
            return this.form.fields.comments = ""
        },
        currentTerminationDate() {
            return this.form.fields.termination_date
        }
    },

    methods: {
        terminationDateUpdated(date) {
            this.form.fields.termination_date = date
        },
        updated(event) {
            this.form.error.clear(event.target.name)
        },
        terminate() {
            this.form.post('/admin/employees/' + this.employee.id + '/terminate/')
                .then(response => {
                    this.isActive = false;
                    this.employee.termination = response.data.termination;
                    this.form.fields = response.data.termination;
                })
        }, 

        reactivate(response) {
            this.isActive = true;
            this.employee.termination = response.termination;
            this.form.reset();
            this.form.fields.termination_date = new Date()
        }
    },

    components: {
        EmployeeReactivation, DatePicker
    },
};
</script>

<style lang="css" scoped>
</style>