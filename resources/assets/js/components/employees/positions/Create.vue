<template>
    <div class="_create_positions">
        <a @click.prevent="showModal">
            Add 
            <i class="fa fa-plus"></i>
        </a>
        <modal name="create-position"
            :adaptive="true"
            :scrollable="true"
            :height="'auto'"
        >
            <position-form></position-form>
        </modal>
    </div>
</template>

<script>
import PositionForm from './_Form';

export default {
    data() {
        return {}
    },

    methods: {
        showModal() {
            this.$modal.show('create-position');
        },

        submitForm() {
            console.log("Form Submitted");
        }
    },

    components: {PositionForm}
}
</script>

<style>

</style>
