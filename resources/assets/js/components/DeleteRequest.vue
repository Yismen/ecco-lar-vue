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
            this.$swal({
                title: 'Are you sure?',
                text: "This action can not be reverted. It will be gone forever. ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
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
            })
        }
    }


}
</script>

<style lang="css" scoped>
</style>