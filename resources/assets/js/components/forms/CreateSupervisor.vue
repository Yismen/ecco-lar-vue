<template>
    <div class="_create_supervisors">
        <modal name="create-supervisor" height="auto" :scrollable="true" @opened="modalOpened">
             <form role="form" class="form-horizontal"
                @submit.prevent="createNew"
                autocomplete="off"
            >
                <div class="box-header with-border">
                    <h4>Create Supervisor</h4>
                </div>

                <div class="box-body">

                    <div class="form-group" :class="{'has-error': form.error.has('name')}">
                        <div class="">
                            <label for="name" class="col-sm-2 control-label">Name:</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" id="create-supervisor-name"
                                            name="name" class="form-control"
                                            v-model="form.fields.name"
                                        >
                                        <div class="input-group-addon"><i class="fa fa-flag"></i></div>
                                    </div>
                                    <span class="text-danger" v-if="form.error.has('name')">{{ form.error.get('name') }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- /. Name -->

                    <div class="form-group" :class="{'has-error': form.error.has('department_id')}">
                        <label for="input" class="col-sm-2 control-label">Department:</label>
                        <div class="col-sm-10">
                            <select name="department_id" id="department_id" class="form-control" v-model="form.fields.name_id">
                                <option v-for="(department, index) in departments_list" :value="department.id" :key="department.id">
                                    {{ department.name }}
                                </option>
                            </select>
                            <span class="text-danger" v-if="form.error.has('department_id')">{{ form.error.get('department_id') }}</span>
                        </div>
                    </div>
                    <!-- ./Department-->

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">CREATE</button>
                </div>

            </form>
        </modal>
    </div>
</template>

<script>

export default {
    name: "CreateSupervisorComponent",
    props: {
        departments_list: {required: true}
    },

    data() {
        return {
            form: new (this.$ioc.resolve('Form')) ({
                'name': '',
            }),
        }
    },

    methods: {
        modalOpened(e) {
            let inputs = e.ref.getElementsByTagName("input")
            if (inputs.length > 0) {
                inputs[0].focus()
            }

        },

        createNew() {
            this.form.post('/api/supervisors', {})
                .then(response => {
                    this.$emit('supervisor-created', response.data)
                    this.form.fields.name = '';
                    this.$swal('Nice!', 'The Supervisor '+response.data.name + ' was added!', 'success')
                    this.$modal.hide('create-supervisor');
                })
        }
    }
}
</script>

<style>

</style>
