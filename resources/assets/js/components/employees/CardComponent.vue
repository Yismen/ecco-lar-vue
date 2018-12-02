<template>
    <div class="_Card well">
        <form class="form-horizontal" role="form"
            @submit.prevent="submitCard"
            autocomplete="off" 
            @change="updated">

            <div class="box-header with-border">
                <h4>{{ employee.full_name }}' Card:</h4>
            </div>
    
            <div class="box-body">
                <div class="form-group" :class="{'has-error': form.error.has('card')}">
                    <label for="input" class="col-sm-2 control-label">Card:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" 
                         id="card" name="card"
                        v-model="form.fields.card">
                        <span class="text-danger" v-if="form.error.has('card')">{{ form.error.get('card') }}</span>
                    </div>
                </div> <!-- ./Card -->
            </div>
    
            <div class="box-footer">
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">
                            Save Card
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</template>

<script>

    export default {

      name: 'CardComponent',

      data () {
        return {
            form: new (this.$ioc.resolve('Form')) ({
                'card': this.employee.card ? this.employee.card.card : '',
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
        submitCard() {
            this.form.post('/admin/employees/'+ this.employee.id +'/card')
                .then(response => {
                    this.employee.card = response.data.card;
                    return this.form.fields = response.data.card
                })
        }
    }
};
</script>

<style lang="css" scoped>
</style>