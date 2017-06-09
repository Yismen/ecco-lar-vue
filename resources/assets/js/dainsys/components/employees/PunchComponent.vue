<template>
    <div class="_Punch">
        <form class="form-horizontal" role="form"
            @submit.prevent="submitPunch"
            autocomplete="off" 
            @keydown="form.error.clear($event.target.name)">

            <div class="box-header with-border">
                <h4>{{ employee.full_name }}' Punch:</h4>
            </div>
    
            <div class="box-body">
                <div class="form-group">
                    <label for="input" class="col-sm-2 control-label">Punch:</label>
                    <div class="col-sm-10">
                        <input type="text" id="punch" 
                        name="punch" class="form-control" 
                        v-model="form.fields.punch">
                        <span class="text-danger" v-if="form.error.has('punch')">{{ form.error.get('punch') }}</span>
                    </div>
                </div> <!-- ./Punch -->
            </div>
    
            <div class="box-footer">
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">
                            Save Punch
                        </button>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
</template>

<script>

    import Form from 'jorge.form'

    export default {

      name: 'PunchComponent',

      data () {
        return {
            form: new Form({
                'punch': this.employee.punch ? this.employee.punch.punch : '',
            }, false)

        };
    },

    props: {
        employee: {}
    },

    methods: {
        submitPunch() {
            this.form.post('/admin/employees/updatePunch/' + this.employee.id)
                .then(response => {
                    this.employee.punch = response.punch;
                    return this.form.fields = response.punch
                })
        }
    }
};
</script>

<style lang="css" scoped>
</style>