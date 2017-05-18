<template>
    <div class="confirm-delete">



        <div class="form-group">
            <a href="#modal-id" @click.prevent="showModal = true" class="btn btn-danger">DELETE</a>
        </div>

        <div class="modal fade" :class="{'in': showModal}" id="modal-id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" 
                            @click.prevent="showModal = false"
                            data-dismiss="modal" aria-hidden="true">&times;
                        </button>
                        <h4 class="modal-title">Delete [{{ title }}]</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger">
                            <strong>Title!</strong> Alert body ...
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" 
                            @click.prevent="showModal = false"data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div> <!-- /Modal -->
    </div>
</template>

<script>
    export default {

        name: 'Confirmation',

        props: {
            title: {},

            closure() {
                console.log("Funtion")
            }
        },

        data () {
            return {
                showModal: false
            };
        }
    };
</script>

<style lang="css" scoped>
    .confirm-delete .in {
        display: block; padding-right: 17px;
    }
</style>