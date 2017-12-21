<template>
    <div class="todos">
        <h1>Tasks</h1>

        <ul class="list-group">
            <li class="list-group-item" v-for="todo in todos">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="1" :checked="todo.completed">
                            {{ todo.name }}
                    </label>

                    <span class="pull-right edit" @click.prevent="completeIt(todo)">
                        <i class="fa fa-pencil"></i>
                    </span>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {

        name: 'TodosComponent',

        data () {
            return {
                todos: [
                    {name: 'Go to sleep', completed: 0},
                    {name: 'Sleep a little', completed: 1},
                    {name: 'Do no more', completed: 0},
                ]
            };
        },

        computed: {
            completeIt(todo) {
                console.log(todo)

                todo.completed = 1
            }
        }
    };
</script>

<style lang="css" scoped>
    .edit {
        color: #fd8e2f;
    }
</style>