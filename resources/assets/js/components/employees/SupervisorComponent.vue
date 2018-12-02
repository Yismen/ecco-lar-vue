<template>
    <div class="_Supervisor well">
        <form class="form-horizontalS" role="form"
            @submit.prevent="handleUpdateUSupervisor"
            autocomplete="off" 
            @change="updated">

            <div class="box-header with-border">
                <h4>{{ employee.full_name }}' Supervisor:</h4>
            </div>
    
            <div class="box-body">
                <div class="form-group" :class="{'has-error': form.error.has('supervisor_id')}">
                    <label for="supervisor_id" class="">Supervisor:</label>
                    <select name="supervisor_id" id="supervisor_id" class="form-control" v-model="form.fields.supervisor_id">
                        <option v-for="(supervisor_id, index) in employee.supervisors_list" :value="index" :key="supervisor_id">{{ supervisor_id }}</option>
                    </select>
                    <span class="text-danger" v-if="form.error.has('supervisor_id')">{{ form.error.get('supervisor_id') }}</span>
                </div> <!-- ./ARS-->
            </div>
    
            <div class="box-footer">
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">
                            Save Supervisor
                        </button>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
</template>

<script>

    export default {

      name: 'SupervisorsComponent',

      data () {
        return {
            form: new (this.$ioc.resolve('Form')) ({
                'supervisor_id': this.employee.supervisor ? this.employee.supervisor.id : '',
            }, false),
        };
    },

    props: {
        employee: {}
    },

    methods: {
        updated(event) {
            this.form.error.clear(event.target.name);
        },
        handleUpdateUSupervisor() {
            this.form.post('/admin/employees/' + this.employee.id + '/supervisor')
                .then(response => {
                    this.employee.supervisor = response.data.supervisor;
                    return this.form.fields.supervisor_id = response.data.supervisor.id
                })
        }
    }
};
</script>

<style lang="css" scoped>
</style>