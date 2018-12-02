<template>
    <div class="_create_positions">

        <modal name="create-afp" @opened="modalOpened">
             <form role="form" class="form-horizonal"
                @submit.prevent="createNew"
                autocomplete="off"
            >
                <div class="box-header with-border">
                    <h4>Create Afp</h4>
                </div>

                <div class="box-body">

                    <div class="form-group" :class="{'has-error': form.error.has('name')}">
                        <div class="">
                            <label for="name" class="col-sm-2 control-label">Name:</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" id="create-afp-name"
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
    name: "CreateAfpComponent",
    data() {
        return {
            form: new (this.$ioc.resolve('Form')) ({
                'name': '',
            }),
        }
    },

    methods: {
        showModal() {
            this.$modal.show('create-afp');
        },

        modalOpened(e) {
            e.ref.getElementsByTagName("input")[0].focus()
        },

        createNew() {
            this.form.post('/api/afps', {})
                .then(response => {
                    this.$emit('afp-created', response.data)
                    this.form.fields.name = '';
                    this.$swal('Nice!', 'The Afp '+response.data.name + ' was added!', 'success')
                    this.$modal.hide('create-afp');
                })
        }
    }
}
</script>

<style>

</style>
