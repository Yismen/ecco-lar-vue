<template>
    <div class="_ARS well">
        <form class="form-horizontal" role="form"
            autocomplete="off"
            @submit.prevent="handleUpdateArs"
            @change="updated"
        >

            <div class="box-header with-border">
                <h4>ARS Info:</h4>
            </div>

            <div class="box-body" :class="{'has-error': form.error.has('ars_id')}">
                <div class="form-group">
                    <label for="input" class="col-xs-3 col-md-12 col-lg-3">ARS:</label>
                    <div class="col-xs-9 col-md-12 col-lg-9">
                        <div class="input-group">
                            <select name="ars_id" id="ars_id" class="form-control" v-model="form.fields.ars_id">
                                <option v-for="ars in ars_list" :value="ars.id" :key="ars.id">{{ ars.name }}</option>
                            </select>
                            <a href="#" @click.prevent="$modal.show('create-ars')" class="input-group-addon">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </div>
                        <span class="text-danger" v-if="form.error.has('ars_id')">{{ form.error.get('ars_id') }}</span>
                    </div>
                </div> <!-- ./ARS-->
            </div>

            <div class="box-footer">
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">
                            Save ARS
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <create-ars-form @ars-created="arsCreated"></create-ars-form>
        <!-- ./ Modal -->
    </div>
</template>

<script>
import CreateArsForm from '../forms/CreateArs'

export default {
name: 'ARSComponent',

data () {
    return {
        ars_list: [],
        form: new (this.$ioc.resolve('Form')) ({
            'ars_id': this.getArsId(),
        }, false)
    };
},

computed: {
    employee() {
        return this.$store.getters['employee/getEmployee']
    }
},

mounted() {
    return this.ars_list = this.employee.ars_list
},

components: {CreateArsForm },

methods: {
    getArsId() {
        return this.$store.getters['employee/getEmployee'].ars_id
    },
    updated(event) {
        this.form.error.clear(event.target.name)
    },
    handleUpdateArs() {
        this.form.put('/admin/employees/' + this.employee.id + '/ars')
            .then(response => {
                this.$store.dispatch('employee/set', response.data)
                return this.form.fields.ars_id = response.data.ars.id
            })
    },
    arsCreated(data) {
        return this.ars_list.unshift(data)
    }
}
};
</script>

<style lang="css" scoped>
</style>
