<template>
    <div class="_Bank Account">
        <form class="form-horizontal" role="form"
            @submit.prevent="handleUpdateBankAccount"
            autocomplete="off" 
            @keyup="updated">
        
        <div class="box-header with-border"><h4>{{ employee.full_name }}' Bank Account Info:</h4></div>
        
        <div class="box-body">
            <div class="col-sm-6">
                <div class="form-group" :class="{'has-error': form.error.has('bank_id')}">
                    <label for="input" class="col-sm-2 control-label">Bank:</label>                
                    <div class="col-sm-10">
                        <select name="bank_id" id="bank_id" class="form-control" v-model="form.fields.bank_id">
                            <option v-for="(bank_id, index) in employee.banks_list" :value="index" :key="bank_id">{{ bank_id }}</option>
                        </select>
                        <span class="text-danger" v-if="form.error.has('bank_id')">{{ form.error.get('bank_id') }}</span>
                    </div>
                </div> <!-- ./Bank-->
            </div>

            <div class="col-sm-6">
                <div class="form-group" :class="{'has-error': form.error.has('bank_id')}">
                    <label for="input" class="col-sm-2 control-label">Account Number:</label>                
                    <div class="col-sm-10">
                        <input type="text" class="form-control" 
                         id="account_number" name="account_number"
                        v-model="form.fields.account_number">
                        <span class="text-danger" v-if="form.error.has('account_number')">{{ form.error.get('account_number') }}</span>
                    </div>
                </div> <!-- ./Account Number-->
                
            </div>
        </div>

        <div class="box-footer">
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <button type="submit" class="btn btn-primary">
                        Save Bank Account
                    </button>
                </div>
            </div>
        </div>
        
    </form>
</div>
</template>

<script>

    export default {

      name: 'BankAccountComponent',

      data () {
        return {
            form: new (this.$ioc.resolve('Form')) ({
                'bank_id': this.employee.bank_account ? this.employee.bank_account.bank_id : '',
                'account_number': this.employee.bank_account ? this.employee.bank_account.account_number : '',
            }, false),
        };
    },

    props: {
        employee: {}
    },

    methods: {
        updated(event) {
            this.form.error.clear(event.target.name);
        },
        handleUpdateBankAccount() {
            this.form.post('/admin/employees/' + this.employee.id + '/bank-account')
                .then(response => {
                    this.employee.bank_account = response.data.bank_account;
                    return this.form.fields = response.data.bank_account
                })
        }
    }
};
</script>

<style lang="css" scoped>
</style>