<template>
    <div class="input-group">
        <select
            class="form-control"
            required="required"
            @change="changed" 
            v-model="selected"
        >
            <option v-for="element in elements"
                :key="element.id" 
                :value="element.id"
                :selected="element.id == current"
            >
                {{ element.name }}
            </option>
        </select>
        <div class="input-group-addon">
            <a href="#" @click.prevent="$modal.show('create-element-' + name)">
                <i class="fa fa-plus"></i> Add
            </a>
        </div>

        <modal :name="'create-element-' + name">
            <slot name="modal-content"></slot>
        </modal>
        
    </div>
</template>

<script>
import {API_ROUTE} from '../config/app'

export default {
    name: 'CREATE--COMPONENT',
    props: {

        name: {
            type: String, 
            default: '',
        }, // the name of the component. It should be unique
        route: '',
        current: {type: Number} // Id of the element to be selected when component is redered
    },

    data() {
        return {
            elements: [],
            selected: this.current
        }
    },

    mounted() {
        this.parseName()
        this.changed();
        axios.get(API_ROUTE + this.route)
            .then(({data}) => {
                return this.elements = data
            }).catch(errors => console.log(errors))
    },

    methods: {
        changed() {
            this.$emit('changed', this.selected)
        },

        afpCreated(response) {
            this.afps.unshift(response)
        },

        parseName() {
            if(this.name == '') {
                this.name = Math.random().toString(25).substring(5,15) 
            }
        }
    },
}
</script>


<style lang="css" scoped>
</style>
