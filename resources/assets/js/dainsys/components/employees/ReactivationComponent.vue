<template>
    <div class="_Reactivation">
        
        <div class="col-sm-12">
            <form class="form-horizontal" role="form"
                @submit.prevent="handleReactivation"
                    autocomplete="off" 
                    @keydown="form.error.clear($event.target.name)">

                <div class="form-group">
                    <legend>{{ employee.full_name }}' is Inactive. Reactivate?</legend>
                </div>

                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="input" class="col-sm-2 control-label">Reactivation Date:</label>
                            <div class="col-sm-10">
                                <input type="date" id="hire_date" 
                                name="hire_date" class="form-control" 
                                v-model="form.fields.hire_date">
                                <span class="text-danger" v-if="form.error.has('hire_date')">{{ form.error.get('hire_date') }}</span>
                            </div>
                        </div> <!-- ./Reactivation Date-->
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-warning">
                                    REACTIVATE
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                        
            </form>
        </div>
    </div>
</template>

<script>

    import Form from 'jorge.form'

    export default {

      name: 'ReactivactionComponent',

      data () {
        return {
            form: new Form({                               
                'hire_date': '',
            })

        };
    },

    props: {
        employee: {}
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