<template>
    <div class="logins">
        <form class="form-horizontal" role="form"
            @submit.prevent="handleCreateLogin"
            autocomplete="off" 
            @keydown="form.error.clear($event.target.name)"
            >

            <div class="box-header with-border">
                <h4>{{ employee.full_name }}' Logins:</h4>
            </div>
    
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
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

                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="input" class="col-sm-2 control-label">System:</label>
                            <div class="col-sm-10">
                                <select name="system_id" id="system_id"
                                    class="form-control select2" v-model="form.fields.system_id"
                                    >
                                    <option v-for="(item, index) in employee.systems_list"
                                    :value="index"
                                    v-text="item"
                                    ></option>
                                </select>
                                <span class="text-danger" v-if="form.error.has('system_id')">{{ form.error.get('system_id') }}</span>
                            </div>
                        </div> <!-- ./System -->
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
                        <th>System</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="login in logins">
                        <td>{{ login.login }}</td>
                        <td>{{ login.system.display_name }}</td>
                        <td>
                            <a :href="'/admin/logins/' + login.id + '/edit'">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>
</template>

<script>

    import Form from '../../vendor/jorge.form'

    export default {

        name: 'LoginsComponent',

        data () {
            return {
                form: new Form({
                    'login': '',
                    'system_id': ''
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
            handleCreateLogin() {
                this.form.post('/admin/employees/logins/' + this.employee.id)
                .then(response => {
                    console.log(response)
                    return this.logins.unshift(response);
                })
            }
        }
    };
</script>

<style lang="css" scoped>
</style>