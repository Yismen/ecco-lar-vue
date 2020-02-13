<template>
    <div class="wrapper">
        <div v-for="employee in employees" :key="employee.id">
            <div class="checkbox" v-bind:class="{ 'bg-danger': isCheked }">
                <label>
                    <input type="checkbox" :value="employee.id" :name="'employee[]'" @change="toggleChecked">
                    <b>{{ employee.full_name }}</b><slot></slot>
                </label>
            </div>
        </div>
    </div>
</template>

<script>

export default {

    data () {
        return {
            isCheked: false,
        };
    },

    props: ['employees'],

    methods: {
        toggleChecked() {
            this.isCheked = ! this.isCheked
        }
    }
};
</script>

<style lang="css" scoped>
</style>
