<script>
    import Form from '../../vendor/jorge.form';
    
    export default {

        name: 'IndexComponent',

        data () {
            return {
                form: new Form({}),

                supervisors: []
            };
        },

        methods: {
            getSupervisors () {
                this.$http.get('/admin/supervisors/list')
                    .then(response => this.supervisors = response.data);
            }
        },

        created() {
            return this.getSupervisors()
        }
    };
</script>

<template>
    <div class="_SupervisorsIndex">
        <div class="box-header box-bordered">
            <h4>
                Supervisors List 
                <a href="/admin/supervisors/create" class="pull-right"><i class="fa fa-plus"></i> Create</a>
            </h4>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="col-sm-2">Show</th>
                            <th class="col-sm-2">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="supervisor in supervisors">
                            <td>{{ supervisor.name }}</td>
                            <td><a :href="'/admin/supervisors/' + supervisor.id"><i class="fa fa-eye"></i></a></td>
                            <td><a :href="'/admin/supervisors/' + supervisor.id + '/edit'"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<style lang="css" scoped>
</style>