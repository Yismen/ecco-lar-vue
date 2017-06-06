<template>
    <div class="_AFP">
        <form class="form-horizontal" role="form"
        @submit.prevent="handleUpdateAfp"
        autocomplete="off" 
        @keydown="form.error.clear($event.target.name)">

        <div class="form-group">
            <legend>{{ employee.full_name }}' AFP Info:</legend>
        </div>

        <div class="form-group">
            <label for="input" class="col-sm-2 control-label">AFP:</label>
            <div class="col-sm-10">
                <select name="afp_id" id="afp_id" class="form-control" v-model="form.fields.afp_id">
                    <option v-for="(afp_id, index) in employee.afp_list" :value="index">{{ afp_id }}</option>
                </select>
                <span class="text-danger" v-if="form.error.has('afp_id')">{{ form.error.get('afp_id') }}</span>
            </div>
        </div> <!-- ./AFP-->

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <button type="submit" class="btn btn-primary">
                    Save AFP
                </button>
            </div>
        </div>
    </form>
</div>
</template>

<script>

    import Form from 'jorge.form'

    export default {

      name: 'AFPComponent',

      data () {
        return {
            form: new Form({
                'afp_id': this.employee.afp ? this.employee.afp.id : '',
            }, false)

        };
    },

    props: {
        employee: {}
    },

    methods: {
        handleUpdateAfp() {
            this.form.post('/admin/employees/updateAfp/' + this.employee.id)
                .then(response => {
                    this.employee.afp = response.afp;
                    return this.form.fields.afp_id = response.afp.id
                })
        }
    }
};
</script>

<style lang="css" scoped>
</style>