<template>
    <div class="_Form">
        <form @submit.prevent="filter">  
            <div class="col-sm-6">
                <h4>Filter Notes</h4>
            </div>
            
            <div class="col-sm-6">
                <div class="input-group">
                    <input type="text" v-model="search" class="form-control" @keyup.prevent="filter" id="search">
                    <div class="input-group-addon" @click.prevent="filter"><i class="fa fa-search"></i></div>
                </div>
            </div>                
        </form>
    </div>
</template>

<script>
    import NotesResults from './NotesResultsComponent';
    export default {

        name: 'NotesFormComponent',

        data () {
            return {
                search: '',
                delay: 300,
                delayed: 0
            };
        },

        mounted() {
            document.getElementById('search').focus();
        },

        components: {
            NotesResults
        },

        methods: {
            filter() {
                if(this.search.length < 2) return;

                clearTimeout(this.delayed);

                let that = this;

                that.delayed = setTimeout(function(){ 
                    that.$http.post('/api/notes/search', {search: that.search})
                        .then(response => that.$emit('notes-searched', response.data))
                }, that.delay);
            }
        }
    };
</script>

<style lang="css" scoped>
</style>