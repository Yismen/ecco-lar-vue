<template>
    <div class="_create_positions">
        <modal name="create-bank" height="auto" :scrollable="true" @opened="modalOpened">
             <form role="form" class="form-horizonal"
                @submit.prevent="createNew"
                autocomplete="off"
            >
                <div class="box-header with-border">
                    <h4>Create Bank</h4>
                </div>

                <div class="box-body">

                    <div class="form-group" :class="{'has-error': form.error.has('name')}">
                        <div class="">
                            <label for="name" class="col-sm-2 control-label">Name:</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" id="create-bank-name"
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
    name: "CreateBankComponent",
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
            this.form.post('/api/banks', {})
                .then(response => {
                    this.$emit('bank-created', response.data)
                    this.form.fields.name = '';
                    this.$swal('Nice!', 'The Bank '+response.data.name + ' was added!', 'success')
                    this.$modal.hide('create-bank');
                })
        }
    }
}
</script>

<style>

</style>
