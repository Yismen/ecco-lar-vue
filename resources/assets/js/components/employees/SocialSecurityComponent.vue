<template>
    <div class="_Social Security well">
        <form class="form-horizontals" role="form"
            @submit.prevent="handleUpdateSocialSecurity"
            autocomplete="off" 
            @change="updated">
        
            <div class="box-header with-border"><h4>{{ employee.full_name }}' Social Security Info:</h4></div>

            <div class="box-body">
                <div class="form-group" :class="{'has-error': form.error.has('number')}">
                    <label for="number" class="">Social Sec. Number:</label>      
                    <input type="text" class="form-control" 
                    id="number" name="number"
                    v-model="form.fields.number">
                    <span class="text-danger" v-if="form.error.has('number')">{{ form.error.get('number') }}</span>
                </div> <!-- ./Social Sec. Number-->
            </div>

            <div class="box-footer">
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">
                            Save Social Security
                        </button>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
</template>

<script>

    export default {

      name: 'SocialSecurityComponent',

      data () {
        return {
            form: new (this.$ioc.resolve('Form')) ({
                'number': this.employee.social_security ? this.employee.social_security.number : '',
            }, false),
        };
    },

    props: {
        employee: {}
    },

    methods: {
        updated(event) {
            this.form.error.clear(event.target.name)
        },
        handleUpdateSocialSecurity() {
            this.form.post('/admin/employees/' + this.employee.id + '/social-security')
                .then(response => {
                    this.employee.social_security = response.data.social_security;
                    return this.form.fields.number = response.data.social_security.number
                })
        }
    }
};
</script>

<style lang="css" scoped>
</style>