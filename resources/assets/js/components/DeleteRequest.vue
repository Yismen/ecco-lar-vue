<template>
    <form
        method="POST"
        style="display: inline-block;"
        @submit.prevent="sendRequest"
    >
        <button type="submit" id="delete-ars" :class="btnClass">
            <i class="fa fa-btn fa-trash" ></i> {{ btnText }}
        </button>
    </form>
</template>

<script>
export default {

    name: 'DeleteRequest',

    props: {
        url: { type: String, required: true},
        redirectUrl: {type: String, default: null},
        payload: { type: Object },
        btnClass: { type: String, default: 'btn btn-danger'},
        btnText: { type: String, default: 'DELETE'},
    },

    methods: {
        sendRequest() {
            axios.delete(this.url, this.payload)
                .then(response => {
                    if (this.redirectUrl) {
                        return window.location.assign(this.redirectUrl)
                    }
                    this.redirectUrl = null
                    this.$emit('delete-request-completed', response.data)
                })
                .catch(errors => {
                    console.log(errors.data)
                    console.log(errors)
                })
        }
    }


}
</script>

<style lang="css" scoped>
</style>