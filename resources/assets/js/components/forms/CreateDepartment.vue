<template>
    <div class="_create_departments">
        <a href="#"
            @click.prevent="$modal.show('create-department')"
        >
            <i class="fa fa-plus"></i>
            Add
        </a>
        <modal name="create-department" height="auto" :scrollable="true" @opened="modalOpened">
             <form role="form" class="form-horizontal"
                @submit.prevent="createNew"
                autocomplete="off"
            >
                <div class="box-header with-border">
                    <h4>Create Department</h4>
                </div>

                <div class="box-body">

                    <div class="form-group" :class="{'has-error': form.error.has('name')}">
                        <div class="">
                            <label for="name" class="col-sm-3 control-label">Name:</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" id="create-department-name"
                                            name="name" class="form-control"
                                            v-model="form.fields.department"
                                        >
                                        <div class="input-group-addon"><i class="fa fa-flag"></i></div>
                                    </div>
                                <span class="text-danger" v-if="form.error.has('name')">{{ form.error.get('name') }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- /. Name -->

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
    name: "CreateDepartment",

    data() {
        return {
            form: new (this.$ioc.resolve('Form')) ({
                name: '',
            }),

        }
    },

    methods: {
        modalOpened(e) {
            this.setFocusOnFirstElement(e)
        },

        createNew() {
            this.form.post('/api/departments')
                .then(response => {
                    this.$emit('department-created', response.data)
                    this.form.fields.department = '';
                    this.$modal.hide('create-department');
                })
        },

        setFocusOnFirstElement(e) {
            let inputs = e.ref.getElementsByTagName("input")
                if (inputs.length > 0) {
                    inputs[0].focus()
                }
        }
    }
}
</script>

<style>

</style>
