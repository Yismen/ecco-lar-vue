<template>
    <div class="NotesResults">
        <div class="row">

            <div class="col-sm-12">
                <div class="box box-primary">

                    <div class="box-header">
                        <h3>
                            {{ note.title }} 
                            <router-link :to="{ path: '/'}"
                                class="pull-right"><i class="fa fa-home"></i></router-link>
                        </h3>
                    </div>

                    <div class="box-body">
                        <div v-html="note.body"></div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</template>

<script>
    export default {

        name: 'NotesDetailsComponent',

        data () {
            return {
                note: {}
            };
        },

        created() {
            this.$http.get('/api/notes/'+this.$route.params.id)
                .then(response => this.note = response.data)
        }
    };
</script>

<style lang="css" scoped>
</style>