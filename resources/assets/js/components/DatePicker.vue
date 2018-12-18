<template>
    <div class="__Date input-group">
        <datepicker
            :input-class="inputClass"
            v-model="selectedDate"
            :name="name"
            :format="format"
            :typeable="typeable"
            @input="changed"

        ></datepicker>
        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker'

export default {
    name: "DatePicker",
    props: {
        name: {default: "date-imput"},
        format: {default: "MM/dd/yyyy"},
        inputClass: {default: "form-control"},
        typeable: {default: true},
        value: {}
    },

    data() {
        return {
            selectedDate: this.value
        }
    },

    methods: {
        changed(date) {
            this.selectedDate = date
            this.$emit('updated', date);
        }
    },

    watch: {
        value(oldValue, newValue) {
            return this.selectedDate = this.value
        }
    },

    components: {
        Datepicker
    }
}
</script>

<style>

</style>
