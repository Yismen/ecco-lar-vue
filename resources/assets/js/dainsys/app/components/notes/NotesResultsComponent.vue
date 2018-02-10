<template>
    <div class="NotesResults">
        <div class="" v-if="hasNotes">

            <router-link :to="{ name: 'notes.show', params: { id: note.id }}"
                v-for="note in notes" class="col-sm-6" :key="note.id" 
                ><h4 v-text="note.title"></h4></router-link>
                <!-- <div class="box-footer">
                    <div class="list-group">
                        <router-link :to="{ name: 'notes.show', params: { id: note.id }}"
                            v-for="note in notes" class="list-group-item col-sm-6" :key="note.id" 
                            ><h4>{{ note.title }}</h4></router-link>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        name: 'NotesResultsComponent',

        props: ['notes'],

        computed: {
            hasNotes() {
                return this.notes.length > 0 ? true : false;
            }
        }
    };
</script>

<style lang="css" scoped>
</style>