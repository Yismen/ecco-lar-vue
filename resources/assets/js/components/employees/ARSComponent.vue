<template>
    <div class="_ARS well">
        <form class="form-horizontal" role="form"
            autocomplete="off"
            @submit.prevent="handleUpdateArs"
            @change="updated"
        >

            <div class="box-header with-border">
                <h4>{{ employee.full_name }}' ARS Info:</h4>
            </div>

            <div class="box-body" :class="{'has-error': form.error.has('ars_id')}">
                <div class="form-group">
                    <label for="input" class="col-sm-2 control-label">ARS:</label>
                    <div class="col-sm-10">
                        <div class="imput-group">
                            <select name="ars_id" id="ars_id" class="form-control" v-model="form.fields.ars_id">
                                <option v-for="(ars_id, index) in employee.ars_list" :value="index" :key="ars_id">{{ ars_id }}</option>
                            </select>
                            <a href="#" @click.prevent="$modal.show('create-ars')">
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
        <create-ars-form></create-ars-form>
        <!-- ./ Modal -->
    </div>
</template>

<script>
import CreateArsForm from '../forms/CreateArs'

export default {
name: 'ARSComponent',

data () {
    return {
        form: new (this.$ioc.resolve('Form')) ({
            'ars_id': this.employee.ars ? this.employee.ars.id : '',
        }, false)
    };
},

props: {
    employee: {}
},

components: {CreateArsForm },

methods: {
    updated(event) {
        this.form.error.clear(event.target.name)
    },
    handleUpdateArs() {
        this.form.post('/admin/employees/' +this.employee.id+ '/ars')
            .then(response => {
                this.employee.ars = response.data.ars;
                return this.form.fields.ars_id = response.data.ars.id
            })
    }
}
};
</script>

<style lang="css" scoped>
</style>