<template>
    <div>
        <div class="modal fade" tabindex="-1" :class="{in: show}" role="dialog" v-show="show">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <slot name="title">
                            <h4>Default Title</h4>    
                        </slot>    
                    </div>
                    <div class="modal-body">
                        <slot></slot>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="saveChanges">Save changes</button>
                    </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
    </div>    
</template>

<script>
    export default {
        name: "_Modal",
        data() {
            return {
                show: false
            }
        },
        methods: {
            saveChages() {
                this.$emit("modal-submitted");
            }
        }
    }
</script>

<style lang="css" scoped>

</style>