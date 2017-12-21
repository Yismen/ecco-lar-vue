<template>
    <div class="test">
        <h3>Test Component</h3>

        <div class="col-sm-6 col-lg-4" v-for="user in users">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ user.name }}</h3>
                </div>
                <div class="panel-body">
                    {{ user.email }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <add-user @add-user="addUser"></add-user>
            </div>
        </div>

    </div>
</template>

<script>
    import users from './../stores/users.js';

    export default {

        name: 'Test',

        data () {
            return {
                users: users
            };
        }, 

        components: {
            'add-user': require('./AddTest')
        },

        methods: {
            addUser(user) {
                this.users.unshift(user);
            }
        }, 

        created() {
             Vue.http.get('/admin/api/test-vue')
                .then(response => {
                    this.users = response.data
                })
                .catch(error => console.log(error))
        }
    };
</script>

<style lang="css" scoped>
</style>