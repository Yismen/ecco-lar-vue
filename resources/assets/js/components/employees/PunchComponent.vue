<template>
    <div class="_Punch well">
        <form class="form-horizontal" role="form"
            @submit.prevent="submitPunch"
            autocomplete="off" 
            @change="updated">

            <div class="box-header with-border">
                <h4>{{ employee.full_name }}' Punch:</h4>
            </div>
    
            <div class="box-body">
                <div class="form-group" :class="{'has-error': form.error.has('punch')}">
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

    export default {

      name: 'PunchComponent',

      data () {
        return {
            form: new (this.$ioc.resolve('Form')) ({
                'punch': this.employee.punch ? this.employee.punch.punch : '',
            }, false),
        }
    },

    props: {
        employee: {}
    },

    methods: {
        updated(event) {
            this.form.error.clear(event.target.name)
        },
        submitPunch() {
            this.form.post('/admin/employees/' + this.employee.id + '/punch')
                .then(response => {
                    this.employee.punch = response.data.punch;
                    return this.form.fields = response.data.punch
                })
        }
    }
};
</script>

<style lang="css" scoped>
</style>