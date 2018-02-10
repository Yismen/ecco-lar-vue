<template>
    <div class="_Supervisor">
        <form class="form-horizontalS" role="form"
            @submit.prevent="handleUpdateUSupervisor"
            autocomplete="off" 
            @keydown="form.error.clear($event.target.name)">

            <div class="box-header with-border">
                <h4>{{ employee.full_name }}' Supervisor:</h4>
            </div>
    
            <div class="box-body">
                <div class="form-group">
                    <label for="supervisor_id" class="">Supervisor:</label>
                    <select name="supervisor_id" id="supervisor_id" class="form-control" v-model="form.fields.supervisor_id">
                        <option v-for="(supervisor_id, index) in employee.supervisors_list" :value="index">{{ supervisor_id }}</option>
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

    import Form from '../../../vendor/jorge.form'

    export default {

      name: 'SupervisorsComponent',

      data () {
        return {
            form: new Form({
                'supervisor_id': this.employee.supervisor ? this.employee.supervisor.id : '',
            }, false)

        };
    },

    props: {
        employee: {}
    },

    methods: {
        handleUpdateUSupervisor() {
            this.form.post('/admin/employees/updateSupervisor/' + this.employee.id)
                .then(response => {
                    this.employee.supervisor = response.supervisor;
                    return this.form.fields.supervisor_id = response.supervisor.id
                })
        }
    }
};
</script>

<style lang="css" scoped>
</style>