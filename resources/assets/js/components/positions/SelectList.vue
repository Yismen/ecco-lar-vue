<template>
    <div class="positions">
        <div class="input-group">
            <select name="position_id"
                id="position_id"
                class="form-control"
                required="required"
                @change="changed"
                v-model="selected"
            >
                <option v-for="position in positions"
                    :key="position.id"
                    :value="position.id"
                    :selected="position.id == selected"
                >
                    {{ position.name_and_department }},
                    ${{ Number(position.salary).toFixed(2) }} -
                    {{ position.payment_type ? position.payment_type.name : '' }}
                </option>
            </select>
            <a href="#" class="input-group-addon" @click.prevent="$modal.show('create-position')">
                <i class="fa fa-plus"></i> Add
            </a>
        </div>
        <!-- / Input group -->
        <create-position @position-created="positionCreated"></create-position>

    </div>
</template>

<script>
import CreatePosition from '../forms/CreatePosition'
import vSelect from 'vue-select'

export default {
    data() {
        return {
            positions: [],
            selected: this.current
        }
    },

    props: {
        current: {type: Number}
    },

    mounted() {
        this.changed();
        axios.get('/api/positions')
            .then(({data}) => {
                return this.positions = data.data
            }).catch(errors => console.log(errors))
    },

    methods: {
        changed() {
            this.$emit('changed', this.selected)
        },

        positionCreated(response) {
            console.log(response.data)
            this.positions.unshift(response)
        }
    },

    components: {CreatePosition, vSelect}
}
</script>

<style>

</style>
