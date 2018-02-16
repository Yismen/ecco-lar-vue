<template>
    <div class="destroy-source">
        <h3 class="text-danger">Destroy {{ source.name }}</h3>

        <form @submit.prevent="submitForm"
            autocomplete="off" 
            @keydown="form.error.clear($event.target.name)">
            <!-- <sources-form :source="source"></sources-form> -->

            <div class="form-group">
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Watch Out</strong> If you continue you will destroy the source named [{{ source.name }}].
                        Are you sure you want to take this action?
                </div>
            </div>

            <hr>

            <div class="form-group">
                <button class="btn btn-default">CANCEL</button>
                <button class="btn btn-danger" type="submit">REMOVE</button>
            </div>

            <div class="form-group">
                <router-link to="/" class="btn btn-primary">
                    <i class="fa fa-home"></i> Back Home
                </router-link>
            </div>

        </form>

    </div>
</template>

<script>
    import Form from '../../../vendor/jorge.form'
    import SourcesForm from './_Form'
    
    export default {

        name: 'DeleteSource',

        data () {
            return {
                form: new Form({
                    name: ''
                }),
                source: {},
                showModal: false
            };
        },

        components: {
            SourcesForm
        },

        methods: {
            submitForm() {
                this.form.delete('/admin/api/sources/'+this.source.slug)
                    .then(response => {
                        this.source = response

                        // this.$route.push({path: '/'});
                    })
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