<template>
    <div class="_Reactivation">
        
        <div class="col-sm-12">
            <div class="box box-danger">
                <form class="form-horizontal" role="form"
                    @submit.prevent="handleReactivation"
                    autocomplete="off" 
                    @keydown="form.error.clear($event.target.name)">

                    <div class="box-header with-border">
                        <h4>{{ employee.full_name }}' is Inactive. Reactivate?</h4>
                    </div>
            
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="input" class="col-sm-4 control-label">Reactivation Date:</label>
                                    <div class="col-sm-8">
                                        <datepicker input-class="form-control input-sm" 
                                            v-model="form.fields.hire_date" 
                                            name="hire_date" 
                                            format="MM/dd/yyyy" 
                                        ></datepicker>
                                        <span class="text-danger" v-if="form.error.has('hire_date')">{{ form.error.get('hire_date') }}</span>
                                    </div>
                                </div> <!-- ./Reactivation Date-->
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-offset-2">
                                        <button type="submit" class="btn btn-danger">
                                            REACTIVATE
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                            
                </form>
            </div>
        </div>
    </div>
</template>

<script>

    import Form from '../../../vendor/jorge.form'

    export default {

      name: 'ReactivactionComponent',

      data () {
        return {
            form: new Form({                               
                'hire_date': new Date(),
            })

        };
    },

    props: {
        employee: {}
    },

    components: {
        'datepicker': require('vuejs-datepicker')
    },

    methods: {
        handleReactivation() {
            this.form.post('/admin/employees/reactivate/' + this.employee.id)
                .then(response => {
                    this.employee.termination = response.termination;
                    this.$emit('employee-reactivated', this.employee)
                    // return this.form.fields = response.termination;
                })
        }
    }
};
</script>

<style lang="css" scoped>
</style>