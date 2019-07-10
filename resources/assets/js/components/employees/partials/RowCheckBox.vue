<template>
    <tr v-bind:class="{ danger: isCheked }">
        <td>
            <div class="checkbox">
                <label>
                    <input type="checkbox" :value="employee.id" :name="'employee[]'" @change="toggleChecked">
                    <b>{{ employee.full_name }}</b>
                </label>
            </div>
        </td>
    </tr>
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
