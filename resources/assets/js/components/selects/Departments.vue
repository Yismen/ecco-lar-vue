<template>
    <div class="input-group">
        <select name="department_id" id="department_id" class="form-control"
            v-model="current"
        >
            <option v-for="department in departments"
                :key="department.id"
                :value="department.id"
            >
                {{ department.department }}
            </option>
        </select>
        <CreateDepartment class="input-group-addon" @department-created="addDepartment" />

    </div>
</template>

<script>
import CreateDepartment from '../forms/CreateDepartment'
export default {

    name: 'Departments',

    data () {
        return {
            departments: [],
            current: null
        }
    },

    props: ['list', 'selected'],

    components: {CreateDepartment},

    mounted() {
        this.current = this.selected
        this.departments = this.list
    },

    methods: {
        addDepartment(department) {
            this.departments.unshift(department)
        }
    }
}
</script>

<style lang="css" scoped>
</style>