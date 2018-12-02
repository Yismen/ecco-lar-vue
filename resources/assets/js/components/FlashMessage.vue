<template>
    
</template>

<script>
export default {
    props: {
        position: {default: 'center'}, //top|top-start|top-end|center|center-start|center-end|bottom|bottom-start|bottom-end
        type: {default: 'info'}, //success|info|warning|error|question
        title: {default: null},
        text: {default: ''},
        footer: {default: null},
        backdrop: {default: true},
        showConfirmButton: {default: true},
        timer: {default: null},
        toast: {default: false},
    },

    mounted() {
        this.emitMessage();
    },

    methods: {
        emitMessage() {
            this.$swal({
                position: this.position,
                type: this.type,
                footer: this.footer, 
                backdrop: this.backdrop,
                title: this.title,
                text: this.text,
                showConfirmButton: this.showConfirmButton,
                timer: this.timer,
                toast: this.toast
            })
        }
    }
}
</script>

<style>

</style>
