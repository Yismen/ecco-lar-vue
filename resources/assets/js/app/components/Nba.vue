<style type="text/css">
    .Nba {
        color:red;
    }

    .Nba--players {
        color:green;
    }

    .Nba--blue {
        color: blue;
    }
</style>

<script>
    export default {

    props: {
        players: [],

        type: {default: 'players'},

        employees: []
    },

    created: function() {
        this.fetchEmployees();
    },

    methods: {

        fetchEmployees: function(){

            var employees = this.$http.get('api/employees')

            this.$http.get('api/employees')
                .then(function(success) {
                    this.employees = success.data.data;
                }, function(errors){
                    console.log(errors);
                });
        },

        deleteEmployee: function(employee) {
            this.$http.delete('api/employees/' + employee.id)
                .then(function(data){
                    this.employees.$remove(employee);                
                }, function(errors){

                });
        }
    }


}
</script>

<template>
    <div class="Nba">
        <div class="Nba--title">
            <h1><slot></slot></h1>
        </div>

        <ul class="list-group">
            <li 
                class="list-group-item" 
                v-for="employee in employees"
            >
                <a href="#">{{ employee.full_name }}</a>

                <a class="pull-right" @click="deleteEmployee(employee)">X</a>
            </li>
        </ul>

        <div class="Nba--{{ type }}">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
    </div>
</template>
