<template>
    <div class="__Date input-group">
        <datepicker
            :input-class="inputClass"
            v-model="currentDate"
            :name="name"
            :format="format"
            :disabledDates="disabledDates"
            :typeable="typeable"
            @input="changed"
            @focusin.native="open"
            @focusout.native="close"

        ></datepicker>
        <div class="input-group-addon icon" @click="open"><i class="fa fa-calendar"></i></div>
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
        value: {default: moment().format('YYYY-MM-DD hh:mm:ss')}
    },

    data() {
        return {
            currentDate: moment(this.value).format('YYYY-MM-DD hh:mm:ss'),
            disabledDates: new Object({
                from: this.allowFutureDates ? '' : new Date,
                to: this.disableSinceManyDaysAgo > 0 ? new Date(moment().subtract(this.disableSinceManyDaysAgo, 'days').format()) : null,
            })
        }
    },
    methods: {
        changed(date) {
            this.$emit('updated', date);
        },
        open() {
            const datepicker = this.$children.find(e => e.$el.className === 'vdp-datepicker');
            const dateInput = datepicker.$el.childNodes[0].childNodes[2];
              datepicker.showCalendar();
            // dateInput.onfocus = () => {
            //   datepicker.showCalendar();
            // }
            // if(!this.$refs.picker.isOpen) {
            //     this.$refs.picker.$el.querySelector("input").focus();
            //     this.$refs.picker.showCalendar();
            // }
        },
        close() {
            const datepicker = this.$children.find(e => e.$el.className === 'vdp-datepicker');
            const dateInput = datepicker.$el.childNodes[0].childNodes[2];
            datepicker.close(true);
            // if(this.$refs.picker.isOpen) {
            //     this.$refs.picker.close(true);
            // }
        }
    },

    components: {
        Datepicker
    }
}
</script>

<style lang="css" scoped>
    .icon {
        cursor: pointer;
    }
</style>
