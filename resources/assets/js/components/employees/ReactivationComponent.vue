<template>
    <div class="_Reactivation">
        <div class="box box-danger" v-if="hasTermination">
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
                                <date-picker input-class="form-control input-sm"
                                    v-model="form.fields.hire_date"
                                    @updated="hireDateUpdated"
                                ></date-picker>
                                    <span class="text-danger" v-if="form.error.has('hire_date')">{{ form.error.get('hire_date') }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Reactivation Date-->
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
</template>

<script>
    import DatePicker from './../DatePicker'

    export default {

      name: 'ReactivactionComponent',

      data () {
        return {
            form: new (this.$ioc.resolve('Form')) ({
                'hire_date': new Date(),
            })

        };
    },

    components: {
        DatePicker
    },

    computed: {
        employee() {
            return this.$store.getters["employee/getEmployee"]
        },
        hasTermination() {
            return ! this.$store.getters["employee/getEmployee"].active
        }
    },

    methods: {
        hireDateUpdated(date) {
            return this.form.fields.hire_date = date
        },
        handleReactivation() {
            this.form.post('/admin/employees/' + this.employee.id + '/reactivate/')
                .then(response => {
                    this.$store.dispatch('employee/set', response.data)
                })
        }
    }
};
</script>

<style lang="css" scoped>
</style>