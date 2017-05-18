<template>
    <div class="show-source">
        <h3>Show</h3>

        <div class="col-sm-6 col-sm-offset-3">
            <div class="info-box">
                <span class="info-box-icon"><i class="fa fa-star"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Name: {{ source.name }}</span>
                    <span class="info-box-text">Slug: {{ source.slug }}</span>
                    <span class="info-box-text pull-right">
                        <router-link :to="{name: 'edit-source'}" :params="{slug: source.slug}" 
                            class="">
                            <i class="fa fa-pencil"></i> Edit
                        </router-link>                        
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>

        <div class="row">
            <div class="col-sm-12">
                <router-link to="/" class="btn btn-primary">
                    <i class="fa fa-home"></i> Back Home
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        name: 'ShowSource',

        data () {
            return {
                source: {}
            };
        },

        created() {
            Vue.http.get('/admin/api/sources/'+this.$route.params.slug)
                .then(response => this.source = response.data)
        }
    };
</script>

<style lang="css" scoped>
</style>