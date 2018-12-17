<template>
    <div class="_create_positions">
        <modal name="create-nationality" height="auto" :scrollable="true">
            <form role="form" class="form-horizonal"
                @submit.prevent="createNew"
                autocomplete="off"
                @change="form.error.clear($event.target.name)"
            >
                <div class="box-header with-border">
                    <h4>Create Nationality</h4>
                </div>

                <div class="box-body">

                    <div class="form-group" :class="{'has-error': form.error.has('name')}">
                        <div class="">
                            <label for="name" class="col-sm-2 control-label">Name:</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" id="name"
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
    name: "CreateNationalityComponent",
    data() {
        return {
            form: new (this.$ioc.resolve('Form')) ({
                'name': '',
            }),
        }
    },

    methods: {
        // showModal() {
        //     this.$modal.show('create-nationality');
        // },

        createNew() {
            this.form.post('/api/nationalities', {})
                .then(response => {
                    this.$emit('nationality-created', response.data)
                    this.$modal.hide('create-nationality');
                })
        }
    }
}
</script>

<style>

</style>
