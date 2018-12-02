<template>
    <div class="input-group">
        <select name="nationality_id" 
            class="form-control"
            equired="required"
            @change="changed" 
            v-model="selected"
        >
            <option v-for="nationality in nationalities"
                :key="nationality.id" 
                :value="nationality.id"
                :selected="nationality.id == current"
            >
                {{ nationality.name }}
            </option>
        </select>
        <div class="input-group-addon">
            <a href=""  @click.prevent="$modal.show('create-nationality')">
                <i class="fa fa-plus"></i> Add
            </a>
        </div>

        <modal name="create-nationality">
            <create-nationality @nationality-created="nationalityCreated"></create-nationality>
        </modal>
        
    </div>
</template>

<script>
import CreateNationality from './Create'

export default {
    data() {
        return {
            nationalities: [],
            selected: this.current
        }
    },

    props: {
        current: {type: Number}
    },

    mounted() {
        this.changed();
        axios.get('/api/nationalities')
            .then(({data}) => {
                return this.nationalities = data
            }).catch(errors => console.log(errors))
    },

    methods: {
        changed() {
            this.$emit('changed', this.selected)
        },

        nationalityCreated(response) {
            this.nationalities.unshift(response)
        }
    },

    components: {CreateNationality}
}
</script>

<style>

</style>
