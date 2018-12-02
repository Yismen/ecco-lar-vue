<template>
    <div class="_form">
        <div class="box-header">
            <h4>
                New Position
                <a @click="$modal.hide('create-position')" class="pull-right">Close</a>
            </h4>
        </div>
        <div class="box-body">
            <form>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">Name</div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>

export default {
    name: "CreatePositionForm",

    data() {
        return {
            showModal: false,
            form: new (this.$ioc.resolve('Form'))({
                'position': ""
            })
        }
    }
}
</script>

<style>

</style>
