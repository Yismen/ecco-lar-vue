<template>
    <div class="_create_login_names">
        <modal
            name="update-login-name-form"
            height="auto"
            :scrollable="true"
            @opened="modalOpened"
            @before-open="beforeOpen"
        >
             <form role="form" class="form-horizonal"
                @submit.prevent="doUpdate"
                autocomplete="off"
            >
                <div class="box-header with-border">
                    <h4>Update LoginName - {{ form.fields.login }}</h4>
                </div>

                <div class="box-body">

                    <div class="form-group" :class="{'has-error': form.error.has('login')}">
                        <div class="">
                            <label for="login" class="col-sm-2 control-label">Name:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" id="login"
                                        name="login" class="form-control"
                                        v-model="form.fields.login"
                                    >
                                    <div class="input-group-addon"><i class="fa fa-flag"></i></div>
                                </div>
                                <span class="text-danger" v-if="form.error.has('login')">{{ form.error.get('login') }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- /. Name -->
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-warning">UPDATE</button>
                </div>

            </form>
        </modal>
    </div>
</template>

<script>

export default {
    name: "UpdateLoginNameComponent",
    data() {
        return {
            form: new (this.$ioc.resolve('Form')) ({
                'login': '',
            }),
            current_index: '',
            login: {}
        }
    },

    methods: {
        beforeOpen(data) {
            this.form.fields.login = data.params.login
            this.login = data.params
            this.current_index = data.params.index
        },

        modalOpened(e) {
            let inputs = e.ref.getElementsByTagName("input")
            if (inputs.length > 0) {
                inputs[0].focus()
            }

        },

        doUpdate() {
            this.form.put('/admin/login_names/' + this.login.id )
                .then(response => {
                    this.$emit('login-name-updated', response.data, this.current_index)
                    this.form.fields.login = ''
                    this.$modal.hide('update-login-name-form')
                    // this.$swal('Nice!', 'The LoginName '+response.data.login + ' was updated!', 'success')
                    this.$swal({
                        toast: true,
                        type: 'success',
                        text: 'The LoginName '+response.data.login + ' was updated!',
                        title: 'Success',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                    })
                })
        }
    }
}
</script>

<style>

</style>
