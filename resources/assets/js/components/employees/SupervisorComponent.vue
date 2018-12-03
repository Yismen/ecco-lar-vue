<template>
    <div class="_Supervisor well">
        <form class="form-horizontal" role="form"
            autocomplete="off"
            @submit.prevent="handleUpdateSupervisor"
            @change="updated"
        >

            <div class="box-header with-border">
                <h4>{{ employee.full_name }}' Supervisor Info:</h4>
            </div>

            <div class="box-body" :class="{'has-error': form.error.has('supervisor_id')}">
                <div class="form-group">
                    <label for="input" class="col-sm-2 control-label">Supervisor:</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <select name="supervisor_id" id="supervisor_id" class="form-control" v-model="form.fields.supervisor_id">
                                <option v-for="(supervisor, index) in supervisors_list" :value="supervisor.id" :key="supervisor.id">{{ supervisor.name }}</option>
                            </select>
                            <a href="#" @click.prevent="$modal.show('create-supervisor')" class="input-group-addon">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </div>
                        <span class="text-danger" v-if="form.error.has('supervisor_id')">{{ form.error.get('supervisor_id') }}</span>
                    </div>
                </div> <!-- ./Supervisor-->
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
        <create-supervisor-form
            @supervisor-created="supervisorCreated"
            :departments_list="employee.departments_list"
        ></create-supervisor-form>
        <!-- ./ Modal -->
    </div>
</template>

<script>
import CreateSupervisorForm from '../forms/CreateSupervisor'

export default {
name: 'SupervisorComponent',

data () {
    return {
        supervisors_list: [],
        form: new (this.$ioc.resolve('Form')) ({
            'supervisor_id': this.employee.supervisor ? this.employee.supervisor.id : '',
        }, false)
    };
},

props: {
    employee: {}
},

components: {CreateSupervisorForm },

mounted() {
    this.supervisors_list = this.employee.supervisors_list
},

methods: {
    updated(event) {
        this.form.error.clear(event.target.name)
    },
    handleUpdateSupervisor() {
        this.form.put('/admin/employees/' + this.employee.id + '/supervisor')
            .then(response => {
                this.employee.supervisor = response.data.supervisor;
                return this.form.fields.supervisor_id = response.data.supervisor.id
            })
    },
    supervisorCreated(supervisor) {
        // return this.supervisors_list = Object.assign({[supervisor.id]: supervisor.name}, this.supervisors_list)
        this.employee.supervisors_list.unshift(supervisor);
    }
}
};
</script>

<style lang="css" scoped>
</style>