<template>
    <div class="__Date input-group">
        <datepicker
            :input-class="inputClass"
            v-model="selectedDate"
            :name="name"
            :format="format"
            :disabledDates="disabledDates"
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
        allowFutureDates: {type: Boolean, default: false},
        disableSinceManyDaysAgo: {type: Number, default: 0},
        typeable: {type: Boolean, default: true},
        value: {}
    },

    data() {
        return {
            selectedDate: this.value,
            disabledDates: new Object({
                from: this.allowFutureDates ? '' : new Date,
                to: this.disableSinceManyDaysAgo > 0 ? new Date(moment().subtract(this.disableSinceManyDaysAgo, 'days').format()) : null,
            })
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
    },

    // computed: {
    //     disabledDates() {
    //         return new Object({
    //             from: this.allowFutureDates ? new Date : moment().subtract(6, 'days'),
    //             to: new Date()
    //         })
    //     }
    // }
}
</script>

<style>

</style>
