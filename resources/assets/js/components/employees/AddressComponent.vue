<template>
    <div class="address">
        <form class="form-horizontal" role="form"
            @submit.prevent="submitAddress"
            autocomplete="off"
            @change="form.error.clear($event.target.name)"
            >

            <div class="box-header with-border"><h4>Address:</h4></div>

            <div class="box-body">


                <div class="form-group" :class="{'has-error': form.error.has('sector')}">
                    <label for="input" class="col-xs-4 col-sm-12 col-md-4">Sector:</label>
                    <div class="col-xs-8 col-sm-12 col-md-8">
                        <input type="text" id="sector"
                        name="sector" class="form-control"
                        v-model="form.fields.sector">
                        <span class="text-danger" v-if="form.error.has('sector')">{{ form.error.get('sector') }}</span>
                    </div>
                </div> <!-- ./Sector -->

                <div class="form-group" :class="{'has-error': form.error.has('street_address')}">
                    <label for="input" class="col-xs-4 col-sm-12 col-md-4">Street Address:</label>
                    <div class="col-xs-8 col-sm-12 col-md-8">
                        <input type="text" id="street_address"
                        name="street_address" class="form-control"
                        v-model="form.fields.street_address">
                        <span class="text-danger" v-if="form.error.has('street_address')">{{ form.error.get('street_address') }}</span>
                    </div>
                </div> <!-- ./Street Address -->

                <div class="form-group" :class="{'has-error': form.error.has('city')}">
                    <label for="input" class="col-xs-4 col-sm-12 col-md-4">City:</label>
                    <div class="col-xs-8 col-sm-12 col-md-8">
                        <input type="text" id="city"
                        name="city" class="form-control"
                        v-model="form.fields.city">
                        <span class="text-danger" v-if="form.error.has('city')">{{ form.error.get('city') }}</span>
                    </div>
                </div> <!-- ./City -->

            <div class="box-footer">
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">
                            SAVE ADDRESS
                        </button>
                    </div>
                </div>
            </div> <!-- /Box Footer -->
        </div> <!-- /Box Body -->
    </form>
</div>
</template>

<script>
export default {

    name: 'AddressComponent',

      data () {
        return {
            form: new (this.$ioc.resolve('Form')) (
                this.getAddress(),
                {reset: false}
            )
        };
    },

    computed: {
        employee() {
            return this.$store.getters["employee/getEmployee"]
        }
    },

    methods: {
        getAddress() {
            return this.$store.getters["employee/getEmployee"].address ?
                this.$store.getters["employee/getEmployee"].address :
                {
                    'sector': '',
                    'street_address': '',
                    'city': ''
                }
        },
        submitAddress() {
            this.form.post('/admin/employees/' + this.employee.id + '/address')
                .then(response => {
                    this.$store.dispatch('employee/set', response.data)
                })
        }
    }
};
</script>

<style lang="css" scoped>
</style>