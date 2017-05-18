<template>
    <div class="sources">
        <h3 class="page-header">Sources:</h3>

        <create-source></create-source>
        <div class="table-responsive">
            <table class="table table-condensed table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th class="col-xs-2 text-center" colspan="2">
                             <router-link :to="{ name: 'create-source'}">
                                <i class="fa fa-plus"></i>
                            </router-link>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="source in sources">
                        <td>{{ source.id }}</td>
                        <td>{{ source.name }}</td>
                        <td class="text-center">
                            <router-link :to="{ name: 'show-source', params: {slug:  source.slug}}">
                                <i class="fa fa-eye"></i>
                            </router-link>
                        </td>
                        <td class="text-center">   
                            <router-link :to="{  name: 'edit-source', params: {slug:  source.slug}}">
                                <i class="fa fa-pencil"></i>
                            </router-link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import shared from './../../core/stores/SourcesStore.js'
    import Http from './../../core/Http.js'
    
    export default {

        name: 'SourcesComponent',

        data () {
            return {
                sources: []
            };
        },

        components: {
            'create-source': require('./CreateSource')
        }, 

        created() {
            if (shared.state.sources.length > 0) {
                return this.sources = shared.state.sources
            }
            // Http.get('/admin/api/sources')
            //     .then(response => this.sources = response.data)
            Vue.http.get('/admin/api/sources')
                .then(response => this.sources = response.data)
        }
    };
</script>

<style lang="css" scoped>
</style>    