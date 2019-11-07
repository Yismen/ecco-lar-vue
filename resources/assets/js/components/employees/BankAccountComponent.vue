<template>
    <div class="_Bank Account">
        <form class="form-horizontal" role="form"
            @submit.prevent="handleUpdateBankAccount"
            autocomplete="off"
            @keyup="updated">

        <div class="box-header with-border">
            <h4>Bank Account Info:</h4>
        </div>

        <div class="box-body">
            <div class="col-md-6">
                <div class="form-group" :class="{'has-error': form.error.has('bank_id')}">
                    <label for="input" class="col-xs-3 col-md-12 col-lg-3">Bank:</label>
                    <div class="col-xs-9 col-md-12 col-lg-9">
                        <div class="input-group">
                            <select name="bank_id" id="bank_id" class="form-control" v-model="form.fields.bank_id">
                                <option v-for="bank in banks_list" :value="bank.id" :key="bank.id">{{ bank.name }}</option>
                            </select>
                            <a href="#" @click.prevent="$modal.show('create-bank')" class="input-group-addon">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </div>
                        <span class="text-danger" v-if="form.error.has('bank_id')">{{ form.error.get('bank_id') }}</span>
                    </div>
                </div> <!-- ./Bank-->
            </div>

            <div class="col-md-6">
                <div class="form-group" :class="{'has-error': form.error.has('bank_id')}">
                    <label for="input" class="col-xs-3 col-md-12 col-lg-3">Account Number:</label>
                    <div class="col-xs-9 col-md-12 col-lg-9">
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
    <create-bank-form @bank-created="bankCreated"></create-bank-form>
</div>
</template>

<script>
import CreateBankForm from '../forms/CreateBank'

    export default {

      name: 'BankAccountComponent',

      data () {
        return {
            banks_list: [],
            form: new (this.$ioc.resolve('Form')) (this.getBankAccountObject(), false),
        };
    },

    mounted() {
        return this.banks_list = this.employee.banks_list
    },

    computed: {
        employee() {
            return this.$store.getters['employee/getEmployee']
        }
    },

    methods: {
        getBankAccountObject() {
            let employee = this.$store.getters['employee/getEmployee'];
            return {
                'bank_id': employee.bank_account ? employee.bank_account.bank_id : '',
                'account_number': employee.bank_account ? employee.bank_account.account_number : '',
            }
        },
        updated(event) {
            this.form.error.clear(event.target.name);
        },
        handleUpdateBankAccount() {
            this.form.put('/admin/employees/' + this.employee.id + '/bank-account')
                .then(response => {
                   this.$store.dispatch('employee/set', response.data)
                })
        },
        bankCreated(bank) {
            this.banks_list.unshift(bank)
        }
    },

    components: {CreateBankForm}
};
</script>

<style lang="css" scoped>
</style>
