<template>
    <div class="logins">
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
                    <div class="col-sm-10">
                        <div class="form-group" :class="{'has-error': form.error.has('login')}">
                            <label for="input" class="col-sm-2 control-label">Login Name:</label>
                            <div class="col-sm-10">
                                <input type="text" id="login" 
                                name="login" class="form-control" 
                                v-model="form.fields.login"
                                >
                                <span class="text-danger" v-if="form.error.has('login')">{{ form.error.get('login') }}</span>
                            </div>
                        </div> <!-- ./Login Name -->
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </form>

        <div class="box-footer">
            <table class="table table-condensed table-bordered">
                <thead>                
                    <tr>
                        <th>Login Name</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="login in logins" :key="login.id">  
                        <td>{{ login.login }}</td>
                        <td>
                            <a :href="'/admin/logins/' + login.id + '/edit'" target="_new_login">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>
</template>

<script>

    export default {

        name: 'LoginNames',

        data () {
            return {
                form: new (this.$ioc.resolve('Form')) ({
                    'login': ''
                }),
                logins: []

            };
        },

        props: {
            employee: {required: true, type: Object}
        },

        created () {
            if (this.employee.logins) {
                return this.logins = this.employee.logins;
            }
        },

        methods: {
            updated(event) {
                this.form.error.clear(event.target.name)
            },
            handleCreateLogin() {
                this.form.post('/admin/employees/' + this.employee.id + '/login-names/create')
                .then(response => {
                    return this.logins.unshift(response);
                })
            }
        }
    };
</script>

<style lang="css" scoped>
</style>