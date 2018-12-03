<template>
    <div class="_Nationality well">
        <form class="form-horizontal" role="form"
            @submit.prevent="handleForm"
            autocomplete="off"
            @change="updated">

            <div class="box-header with-border">
                <h4>{{ employee.full_name }}' Nationality:</h4>
            </div>

            <div class="box-body">
                <div class="form-group" :class="{'has-error': form.error.has('nationality_id')}">
                    <label for="nationality_id" class="col-sm-2">Nationality:</label>
                    <div class="col-sm-10">
                        <nationality-select :current="employee.nationality.id" @changed="nationalityUpdated" v-model="form.fields.nationality_id"
                        ></nationality-select>
                        <span class="text-danger" v-if="form.error.has('nationality_id')">{{ form.error.get('nationality_id') }}</span>
                    </div>
                </div>
            </div>
             <!-- ./Nationality-->
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

    import NationalitySelect from '../nationalities/SelectList'

    export default {

      name: 'NationalityComponent',

      data () {
        return {
            form: new (this.$ioc.resolve('Form')) ({
                'nationality_id': this.employee.nationality ? this.employee.nationality.id : '',
            }, false),
        };
    },

    props: {
        employee: {}
    },

    components: {
        NationalitySelect
    },

    methods: {
        updated(event) {
            this.form.error.clear(event.target.name)
        },
        handleForm() {
            this.form.post('/admin/employees/' + this.employee.id + '/nationality')
                .then(response => {
                    this.employee.nationality = response.data.nationality;
                    return this.form.fields.nationality_id = response.data.nationality.id
                })
        },
        nationalityUpdated(id) {
            return this.form.fields.nationality_id = id
        }
    }
};
</script>

<style lang="css" scoped>
</style>