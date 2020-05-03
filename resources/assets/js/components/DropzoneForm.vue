<template>
    <div>
        <vue-dropzone
            ref="dainsys-vue-dropzone"
            id="dropzone"
            :options="dropzoneOptions"
            @vdropzone-success="filesUploaded"
            @vdropzone-error="errorHappened"
        ></vue-dropzone>
        <div class="box-footer" v-if="uploadedFiles.length > 0">
            <ul>
                <li v-for="(file, index) in uploadedFiles" :key="index">
                    {{ file }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import vue2Dropzone from 'vue2-dropzone'

export default {

    name: 'DropzoneForm',

    data () {
        return {
            uploadedFiles: [],
            dropzoneOptions: {
                url: this.url,
                thumbnailWidth: 50,
                dictDefaultMessage: "<i class='fa fa-cloud-upload'></i> DRAG FILES HERE TO UPLOAD THE DATA",
                addRemoveLinks: true,
                uploadMultiple: true,
                timeout: 0,
                // chunking: true,
                paramName: 'excel_file',
                acceptedFiles: '.csv,text/*',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                chunksUploaded: function(response, done) {
                    Vue.swal({
                        type: 'success',
                        title: 'Done!',
                        text: response.name,
                        toast: true,
                        position: 'bottom-end',
                        timer: 10000,
                        background: '#f5f5f5',
                        padding: '5em',
                    })

                    done()
                },
                successmultiple: function(response) {
                    response.forEach(file => {
                        Vue.swal({
                            type: 'success',
                            title: 'File Uploaded!',
                            text: `File ${file.name} was uploaded and will be processed by the backend.
                            You will be notified by Email and by the app!`,
                            showConfirmButton: false,
                            position: 'bottom-end',
                            timer: 10000,
                            background: '#f5f5f5',
                            padding: '5em',
                        })
                    })
                }
            }
        }
    },
    props: ['url'],
    components: {
        vueDropzone: vue2Dropzone
    },
    methods: {
        filesUploaded(file) {
            this.uploadedFiles.push(file.name)
        },
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
