<style type="text/css" scoped>
</style>

<template>
    <div class="Employee">
        <div class="Employee--title">
            <h1>
                <slot>Employees List</slot> 
                <span v-show="remaining">({{ remaining }})</span>
                <a class="pull-right" @click="fetchEmployees">
                    Refresh
                </a>
            </h1>
        </div>
        <loading></loading>
        <ul class="list-group">
            <li 
                class="list-group-item" 
                v-for="employee in employees"
            >
                <a href="#">{{ employee.full_name }}, {{ employee.id }}</a>

                <a class="pull-right" @click="deleteEmployee(employee)">X</a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {

    components: {
        loading: require('./Loading.vue')
    },

    props: {
        employees: [],
        loading: require('./Loading.vue')
    },

    computed: {
        remaining: function() {
            return this.employees ? this.employees.length : 0
        }
    },

    methods: {

        fetchEmployees: function(){

            // this.loading.show_loading = true;

            this.$http.get('api/employees')
                .then(function(success) {
                    this.employees = success.data.data;
                }, function(errors){
                    console.log(errors);
                });

            // this.loading.show_loading = false;

        },

        deleteEmployee: function(employee) {
            this.$http.delete('api/employees/' + employee.id)
                .then(function(data){
                    console.log(data);
                    this.employees.$remove(employee);                
                }, function(errors){

                });
        }
    },

    created: function() {
        this.fetchEmployees();
    }


}
</script>
