<template>
    <div class="create-source">
        <h3>Create a New Source</h3>

        <form @submit.prevent="submitForm"
            autocomplete="off" 
            @keydown="form.error.clear($event.target.name)">
            <!-- <sources-form :source="source"></sources-form> -->

            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Name:</label>
                <div class="col-sm-10">

                    <div class="input-group">
                        <input type="text" class="form-control" title="name" v-model="form.fields.name">
                        <span class="input-group-btn">
                            <button class="btn btn-success" type="submit">CREATE!</button>
                        </span>
                    </div><!-- /input-group -->

                    <span class="text-danger" v-if="form.error.has('name')"
                        v-text="form.error.get('name')"></span>

                </div> <!-- /Col span -->
            </div><!-- ./Form Group -->

            <div class="form-group">
                <router-link to="/" class="btn btn-primary">
                    <i class="fa fa-home"></i> Back Home
                </router-link>
            </div>

        </form>

    </div>
</template>

<script>
    import Form from '../../vendor/jorge.form'

    import shared from './../../core/stores/SourcesStore.js'
    export default {

        name: 'EditSource',

        data () {
            return {
                form: new Form({
                    name: ''
                }),
                source: {},
                shared
            };
        },

        components: {
            'sources-form': require('./_Form')
        },

        methods: {
            submitForm() {
                this.form.post('/admin/api/sources')
                    .then(response => this.shared.addNewSource(response))
            }
        }
    };
</script>

<style lang="css" scoped>
</style>