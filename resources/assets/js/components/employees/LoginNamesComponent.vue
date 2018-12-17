<template>
    <div class="login-names">
        <form class="form-horizontal" role="form"
            @submit.prevent="handleCreateLogin"
            autocomplete="off"
            @change="updated"
            >

            <div class="box-header with-border">
                <h4>{{ employee.full_name }}' Logins:</h4>
            </div>

            <div class="box-body">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="form-group" :class="{'has-error': form.error.has('login')}">
                            <label for="input" class="col-sm-2 control-label">Login Name:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" id="login"
                                        name="login" class="form-control"
                                        v-model="form.fields.login"
                                    >

                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="submit">CREATE</button>
                                    </span>

                                </div>
                                <span class="text-danger" v-if="form.error.has('login')">{{ form.error.get('login') }}</span>
                            </div>

                        </div>
                        <!-- ./Login Name -->
                    </div>
                </div>
            </div>

        </form>

        <div class="box-footer" v-if="login_names.length">
            <table class="table table-condensed table-bordered">
                <thead>
                    <tr>
                        <th>Login Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(login, index) in login_names" :key="login.id">
                        <td>{{ login.login }}</td>
                        <td class="col-sm-2">
                            <a href="#"@click.prevent="updateLogin(index, login)">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

        <update-login-name-form @login-name-updated="loginNameUpdated"></update-login-name-form>
    </div>
</template>

<script>
    import UpdateLoginNameForm from '../forms/UpdateLoginName'

    export default {

        name: 'LoginNames',

        data () {
            return {
                form: new (this.$ioc.resolve('Form')) ({
                    'login': ''
                }),
            };
        },

        computed: {
            employee() {
                return this.$store.getters['employee/getEmployee']
            },
            login_names() {
                return this.$store.getters['employee/getEmployee'].login_names
            }
        },

        methods: {
            updated(event) {
                this.form.error.clear(event.target.name)
            },
            updateLogin(index, login) {
                login.index = index
                this.$modal.show('update-login-name-form', login)
            },
            loginNameUpdated(login_name, index) {
                login_name.index = index
                this.$store.dispatch('employee/updateLoginName', login_name)
            },
            handleCreateLogin() {
                this.form.post('/admin/employees/' + this.employee.id + '/login-names')
                    .then(response => {
                        return this.$store.dispatch('employee/addLoginName', response.data)
                    })
            }
        },

        components: {UpdateLoginNameForm}
    };
</script>

<style lang="css" scoped>
</style>