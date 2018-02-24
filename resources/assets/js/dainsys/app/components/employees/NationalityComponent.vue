<template>
    <div class="_Nationality well">
        <form class="form-horizontalS" role="form"
            @submit.prevent="handleForm"
            autocomplete="off" 
            @change="updated">

            <div class="box-header with-border">
                <h4>{{ employee.full_name }}' Nationality:</h4>
            </div>
    
            <div class="box-body">
                <div class="form-group">
                    <label for="nationality_id" class="">Nationality:</label>
                    <select name="nationality_id" id="nationality_id" class="form-control" v-model="form.fields.nationality_id">
                        <option v-for="(nationality_id, index) in employee.nationalities_list" :value="index" :key="nationality_id">{{ nationality_id }}</option>
                    </select>
                    <span class="text-danger" v-if="form.error.has('nationality_id')">{{ form.error.get('nationality_id') }}</span>
                </div> <!-- ./ARS-->
            </div>
    
            <div class="box-footer" v-if="showButton">
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
            }, false),
            showButton: false
        };
    },

    props: {
        employee: {}
    },

    methods: {
        updated(event) {
            this.showButton = true;
            this.form.error.clear(event.target.name)
        },
        handleForm() {
            this.form.post('/admin/employees/updateNationality/' + this.employee.id)
                .then(response => {
                    this.employee.nationality = response.nationality;
                    this.showButton = false;
                    return this.form.fields.nationality_id = response.nationality.id
                })
        }
    }
};
</script>

<style lang="css" scoped>
</style>