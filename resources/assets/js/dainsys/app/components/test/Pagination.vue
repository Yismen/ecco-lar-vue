<template>
    <div class="pagination">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users.data">
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                    </tr>
                </tbody>
            </table>
            <pagination :data="users" @pagination-change-page="fetchUsers"></pagination>
        </div>
    </div>
</template>

<script>

    export default {

        name: 'PaginateUsers',

        data () {
            return {
                users: {}
            };
        },

        components: {
            // 'pagination': require('laravel-vue-pagination')
        },

        created() {
            this.fetchUsers();
        },

        methods: {
            fetchUsers(page) {
                this.$http.get('/admin/api/test/pagination?page=' + page)
                    .then(response => {
                        return this.users = response.data;
                    })
            }
        }
    };
</script>

<style lang="css" scoped>
</style>