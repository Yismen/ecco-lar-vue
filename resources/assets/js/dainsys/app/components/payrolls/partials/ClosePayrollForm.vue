<template>  
    <div class="_ClosePayrollForm">
        <div class="box box-warning">
            <div class="box-body">
                <form class="form-horizontal" role="form">  
                    <div class="form-group" :class="{'has-error': form.error.has('payment_date')}">
                        <div class="col-xs-8">
                            <label for="payment_date" class="col-sm-2 control-label">Payment Date:</label>
                            <div class="col-sm-10">
                                <datepicker input-class="form-control" 
                                    v-model="form.fields.payment_date" 
                                    name="payment_date" 
                                    id="payment_date"
                                    format="MM/dd/yyyy" 
                                ></datepicker>
                                <span class="text-danger" v-show="form.error.has('payment_date')">{{ form.error.get('payment_date') }}</span>
                            </div>  
                        </div>
                        <div class="col-xs-4">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary">Close Payroll</button>

                                Date: {{ fucking_date }}
                            </div>
                        </div>
                    </div>
                    <!-- /. Payment Date -->
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Form from '../../../vendor/dainsys-form';
    import Datepicker from 'vuejs-datepicker';

    export default {

        name: 'ClosePayrollForm',

      data () {
        return {
            form: new Form({
                payment_date: ''
            }, {notify: false})
        };
    },

    computed: {
        fucking_date() {
            console.log(this.$store)
            return this.$store.getters.today;
        }
    },

    components: {        
        'datepicker': Datepicker
    }
};
</script>

<style lang="css" scoped>
</style>