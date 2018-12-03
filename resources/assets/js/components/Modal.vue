<template>
    <div class="div">
        <js-modal
            @opened="modalOpened"
            @closed="modalClosed"
            :name="name"
            :delay="delay"
            :resizable="resizable"
            :adaptive="adaptive"
            :draggable="draggable"
            :scrollable="scrollable"
            :clickToClose="clickToClose"
            :transition="transition"
            :overlayTransition="overlayTransition"
            :height="height"
        >
            <slot></slot>
        </js-modal>
    </div>
</template>

<script>
import JsModal from 'vue-js-modal'

export default {
    props: {
        show: {type Boolean, default: false},
        name: {type: String, required: true},
        delay: {type: Number, default: 0},
        resizable: {type: Boolean, default: false},
        adaptive: {type: Boolean, default: false},
        draggable: {type: Boolean, default: false},
        scrollable: {type: Boolean, default: true},
        reset: {type: Boolean, default: false},
        clickToClose: {type: Boolean, default: true},
        transition: {type: String, default: ''},
        overlayTransition: {type: String, default: 'overlay-fade'},
        classes: {type: String|Array, default: 'v--modal'},
        width: {type: String|Number, default: 600},
        height: {type: String|Number, default: 'auto'},
    },

    methods: {
        showModal() {
            this.$modal.show(this.name)
        },
        hideModal() {
            this.$modal.hide(this.name)
            this.$emit('modal-closed')
        },
        modalClosed() {
            this.hideModal()
        },
        modalOpened(e) {
            let els = e.ref.getElementsByTagName("input")
            if (els.lenght > 0) {
                els[0].focus()
            }
        }
    },

    watch: {
        show() {
            if (this.show == true) {
                return this.showModal()
            }
            return this.hideModal()
        }
    },

    components: {JsModal}
}
</script>

<style>

</style>
