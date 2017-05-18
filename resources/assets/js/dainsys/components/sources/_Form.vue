<template>
    <div class="sources-form">
        <div class="form-group">
            <label for="input" class="col-sm-2 control-label">Name:</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="text" class="form-control" title="name" v-model="source.name">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button">Go!</button>
                    </span>
                </div><!-- /input-group -->
            </div> <!-- /Col span -->
        </div><!-- ./Form Group -->
    </div>
</template>

<script>
    export default {

        name: '_Form',

        props: {
            source: {}
        },

        data () {
            return {

            };
        }
    };
</script>

<style lang="css" scoped>
</style>