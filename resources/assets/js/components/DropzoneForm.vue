<template>
    <vue-dropzone
        ref="myVueDropzone"
        id="dropzone"
        :options="dropzoneOptions"
        @vdropzone-error="errorHappened"
    ></vue-dropzone>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {

    name: 'DropzoneForm',

    data () {
        return {
            dropzoneOptions: {
                url: this.url,
                thumbnailWidth: 150,
                dictDefaultMessage: "<i class='fa fa-cloud-upload'></i> DRAG FILES HERE TO UPLOAD THE DATA",
                // addRemoveLinks: true,
                uploadMultiple: true,
                paramName: 'excel_file',
                acceptedFiles: 'application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                successmultiple: function() {
                    location.reload()
                }
            }
        }
    },
    props: ['url'],
    components: {
        vueDropzone: vue2Dropzone
    },
    methods: {
        errorHappened(error, errorMessage) {
            let message = errorMessage.errors[Object.keys(errorMessage.errors)[0]][0]

            Vue.swal({
                type: 'error',
                title: 'File Errors',
                text: errorMessage.errors[Object.keys(errorMessage.errors)[0]][0],
                toast: true,
                showConfirmButton: false,
                position: 'top-end',
                timer: 10000,
                background: '#F2DEDE',
                padding: '5em',
            })
        }
    }
}
</script>

<style lang="css" scoped>
</style>
