<template>
    <div class="_Nationality">
        <form class="form-horizontalS" role="form"
            @submit.prevent="handleForm"
            autocomplete="off" 
            @keydown="form.error.clear($event.target.name)">

            <div class="box-header with-border">
                <h4>{{ employee.full_name }}' Nationality:</h4>
            </div>
    
            <div class="box-body">
                <div class="form-group">
                    <label for="nationality_id" class="">Nationality:</label>
                    <select name="nationality_id" id="nationality_id" class="form-control" v-model="form.fields.nationality_id">
                        <option v-for="(nationality_id, index) in employee.nationalities_list" :value="index">{{ nationality_id }}</option>
                    </select>
                    <span class="text-danger" v-if="form.error.has('nationality_id')">{{ form.error.get('nationality_id') }}</span>
                </div> <!-- ./ARS-->
            </div>
    
            <div class="box-footer">
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">
                            Save Nationality
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

      name: 'NationalityComponent',

      data () {
        return {
            form: new Form({
                'nationality_id': this.employee.nationality ? this.employee.nationality.id : '',
            }, false)

        };
    },

    props: {
        employee: {}
    },

    methods: {
        handleForm() {
            this.form.post('/admin/employees/updateNationality/' + this.employee.id)
                .then(response => {
                    this.employee.nationality = response.nationality;
                    return this.form.fields.nationality_id = response.nationality.id
                })
        }
    }
};
</script>

<style lang="css" scoped>
</style>