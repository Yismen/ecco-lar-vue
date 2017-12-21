<template>
    <div class="_ARS">
        <form class="form-horizontal" role="form"
            @submit.prevent="handleUpdateArs"
            autocomplete="off" 
            @keydown="form.error.clear($event.target.name)">

            <div class="box-header with-border">
                <h4>{{ employee.full_name }}' ARS Info:</h4>
            </div>
    
            <div class="box-body">
                <div class="form-group">
                    <label for="input" class="col-sm-2 control-label">ARS:</label>
                    <div class="col-sm-10">
                        <select name="ars_id" id="ars_id" class="form-control" v-model="form.fields.ars_id">
                            <option v-for="(ars_id, index) in employee.ars_list" :value="index">{{ ars_id }}</option>
                        </select>
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
    </div>
</template>

<script>

    import Form from '../../../vendor/jorge.form'

    export default {

      name: 'ARSComponent',

      data () {
        return {
            form: new Form({
                'ars_id': this.employee.ars ? this.employee.ars.id : '',
            }, false)

        };
    },

    props: {
        employee: {}
    },

    methods: {
        handleUpdateArs() {
            this.form.post('/admin/employees/updateArs/' + this.employee.id)
                .then(response => {
                    this.employee.ars = response.ars;
                    return this.form.fields.ars_id = response.ars.id
                })
        }
    }
};
</script>

<style lang="css" scoped>
</style>