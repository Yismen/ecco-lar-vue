<template>
    <div class="edit-source">
        <h3>Edit {{ source.name }}</h3>

        <form @submit.prevent="submitForm"
            autocomplete="off" 
            @keydown="form.error.clear($event.target.name)">
            <!-- <sources-form :source="source"></sources-form> -->

            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Name:</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="text" class="form-control" title="name" v-model="form.fields.name = source.name">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">Go!</button>
                        </span>
                    </div><!-- /input-group -->

                    <span class="text-danger" v-if="form.error.has('name')"
                        v-text="form.error.get('name')"></span>
                </div> <!-- /Col span -->
            </div><!-- ./Form Group -->

            <!-- <confirm-delete :title="source.name" :closure="cFunction"></confirm-delete> -->

            <div class="form-group">
                <router-link to="/" class="btn btn-primary">
                    <i class="fa fa-home"></i> Back Home
                </router-link>
            </div>

        </form>


    </div>
</template>

<script>
    import Form from 'jorge.form'
    export default {

        name: 'EditSource',

        data () {
            return {
                form: new Form({
                    name: ''
                }),
                source: {}
            };
        },

        components: {
            'sources-form': require('./_Form'),
            'confirm-delete': require('./../Confirmation')
        },

        methods: {
            submitForm() {
                this.form.put('/admin/api/sources/'+this.source.slug)
                    .then(response => this.source = response)
            },

            cFunction() {
                console.log("another function")
            }
        },

        created() {
            Vue.http.get('/admin/api/sources/'+this.$route.params.slug)
                .then(response => this.source = response.data)
        }
    };
</script>

<style lang="css" scoped>
</style>