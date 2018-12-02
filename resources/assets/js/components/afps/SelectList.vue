<template>
    <div class="input-group">
        <select name="afp_id" 
            class="form-control"
            equired="required"
            @change="changed" 
            v-model="selected"
        >
            <option v-for="afp in afps"
                :key="afp.id" 
                :value="afp.id"
                :selected="afp.id == current"
            >
                {{ afp.name }}
            </option>
        </select>
        <div class="input-group-addon">
            <a href=""  @click.prevent="$modal.show('create-afp')">
                <i class="fa fa-plus"></i> Add
            </a>
        </div>

        <modal name="create-afp">
            <create-afp @afp-created="afpCreated"></create-afp>
        </modal>
        
    </div>
</template>

<script>
import CreateAfp from './Create'

export default {
    data() {
        return {
            afps: [],
            selected: this.current
        }
    },

    props: {
        current: {type: Number}
    },

    mounted() {
        this.changed();
        axios.get('/api/afps')
            .then(({data}) => {
                return this.afps = data
            }).catch(errors => console.log(errors))
    },

    methods: {
        changed() {
            this.$emit('changed', this.selected)
        },

        afpCreated(response) {
            this.afps.unshift(response)
        }
    },

    components: {CreateAfp}
}
</script>

<style>

</style>
