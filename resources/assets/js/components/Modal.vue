<template>
    <div>
        <div class="modal fade" tabindex="-1" :class="{in: showing}" role="dialog" v-show="showing" style="display: block">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="hide" ><span aria-hidden="true">&times;</span></button>
                        <slot name="modal-title">
                            <h4>Default Title</h4>    
                        </slot>    
                    </div>
                    <div class="modal-body">
                        <slot></slot>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" @click="hide" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="saveChanges">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>    
</template>

<script>
    export default {
        name: "Modal",
        props: ['show'],
        data() {
            return {
                showing: false
            }
        },
        watch: {
            show() {
                return this.showing = this.show
            }
        },
        methods: {
            saveChanges() {
                // this.hide()
                this.$emit("modal-submitted");
            },
            hide() {
                this.showing = false
                this.$emit("modal-hidden");
            }
        }
    }
</script>

<style lang="css" scoped>

</style>