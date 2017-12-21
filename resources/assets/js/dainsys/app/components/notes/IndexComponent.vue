<template>
    <div class="NotesIndex">
        <div class="box box-primary">
            
            <div class="box-body">
                <notes-form @notes-searched="notesSearched"></notes-form>
            </div>
        </div>

        <div class="box box-success" v-show="hasNotes">
            <div class="box-body">
                <notes-results :notes="notes"></notes-results>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        name: 'NotesIndexComponent',

        data () {
            return {
                notes: []
            };
        },

        mounted() {
            document.getElementById('search').focus();
        },

        components: {
            'notes-form': require('./_FormComponent'),
            'notes-results': require('./NotesResultsComponent'),
        },

        methods: {
            notesSearched(notes) {
                return this.notes = notes
            }
        },

        computed: {
            hasNotes() {
                return this.notes.length > 0 ? true : false;
            }
        }
    };
</script>

<style lang="css" scoped>
</style>