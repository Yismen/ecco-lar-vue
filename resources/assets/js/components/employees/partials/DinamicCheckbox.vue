<template>
    <div class="checkbox" v-bind:class="{ 'bg-danger': isCheked }">
        <label>
            <input type="checkbox" :value="employee.id" :name="'employee[]'" @change="toggleChecked">
            {{ employee.full_name }}<slot></slot>
        </label>
    </div>
</template>

<script>

export default {

    data () {
        return {
            isCheked: false,
        };
    },

    props: ['employee'],

    methods: {
        toggleChecked() {
            this.isCheked = ! this.isCheked
        }
    }
};
</script>

<style lang="css" scoped>
</style>
