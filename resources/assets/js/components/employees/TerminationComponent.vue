<template>
    <div class="_Termination" >

        <div class="box-header with-border bg-disabled" :class="[isActive ? 'bg-green' : 'bg-yellow']">
            <h4>Current Status is {{ employee.status }}</h4>
        </div>

        <div class="box box-info">
            <form class="" role="form"
                @submit.prevent="terminate"
                autocomplete="off"
                @keydown="form.error.clear($event.target.name)"
                @change="form.error.clear($event.target.name)"
            >

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group" :class="{'has-error': form.error.has('termination_date')}">
                                <label for="input" class="">Date:</label>
                                <date-picker input-class="form-control input-sm"
                                    v-model="form.fields.termination_date"
                                    @updated="updateTerminationDate"
                                ></date-picker>
                                <span class="text-danger" v-if="form.error.has('termination_date')">{{ form.error.get('termination_date') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" :class="{'has-error': form.error.has('termination_type_id')}">
                                <label for="input" class="">Termination Type:</label>
                                <div class="">
                                    <select name="termination_type_id" id="termination_type_id" class="form-control input-sm" v-model="form.fields.termination_type_id">
                                        <option v-for="type in employee.termination_type_list" :value="type.id" :key="type.id">
                                            {{ type.name }}
                                        </option>
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
                                        <option v-for="reason in employee.termination_reason_list" :value="reason.id" :key="reason.id">
                                            {{ reason.reason }}
                                        </option>
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
                                    <textarea
                                        id="comments"
                                        name="comments" class="form-control input-sm"
                                        v-model="form.fields.comments" rows="5"
                                        :required="reasonIsOther"
                                    ></textarea>
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

        <EmployeeReactivation
            :current="employee.hire_date"
            @employee-reactivated="reactivated"/>
    </div>
</template>

<script>
    import EmployeeReactivation from './ReactivationComponent';
    import DatePicker from './../DatePicker'

    export default {

    name: 'TerminationComponent',

    data () {
        return {
            form: new (this.$ioc.resolve('Form')) (
                this.getTermination(),
                {reset: false}
            )
        };
    },

    computed: {
        isActive() {
            return this.$store.getters["employee/getEmployee"].active
        },
        employee() {
            return this.$store.getters["employee/getEmployee"]
        },
        reasonIsOther() {
            let currentId = this.form.fields.termination_reason_id

            let currentReason =  this.employee.termination_reason_list.filter(function(item) {
                return item.id == currentId
            })

            currentReason = currentReason[0] ? currentReason[0].reason : ""
            return String(currentReason).toLowerCase() == "other"
        }
    },

    methods: {
        updateTerminationDate(date) {
            this.form.fields.termination_date = date
        },
        terminate() {
            this.form.post('/admin/employees/' + this.employee.id + '/terminate/')
                .then(response => {
                    this.$store.dispatch('employee/set', response.data)
                })
        },
        getTermination() {
            return this.$store.getters['employee/getEmployee'].termination ?
                    this.$store.getters['employee/getEmployee'].termination :
                    {
                        termination_date: new Date,
                        termination_type_id: null,
                        termination_reason_id: null
                    }
        },
        reactivated(data) {
            console.log(data)
            this.$store.dispatch('employee/set', data)
            this.form.fields = {
                can_be_rehired: '',
                termination_date: new Date(),
                termination_reason_id: '',
                termination_type_id: ''
            }
        }
    },

    components: {
        EmployeeReactivation, DatePicker
    },
};
</script>

<style lang="css" scoped>
</style>
