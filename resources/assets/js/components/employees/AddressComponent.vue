<template>
    <div class="address">
        <form class="form-horizontal" role="form"
            @submit.prevent="submitAddress"
            autocomplete="off"
            @change="updated">

            <div class="box-header with-border"><h4>{{ $store.getters["employee/getEmployee"].full_name }}' Address:</h4></div>

            <div class="box-body">


                <div class="form-group" :class="{'has-error': form.error.has('sector')}">
                    <label for="input" class="col-sm-2 control-label">Sector:</label>
                    <div class="col-sm-10">
                        <input type="text" id="sector"
                        name="sector" class="form-control"
                        v-model="form.fields.sector">
                        <span class="text-danger" v-if="form.error.has('sector')">{{ form.error.get('sector') }}</span>
                    </div>
                </div> <!-- ./Sector -->

                <div class="form-group" :class="{'has-error': form.error.has('street_address')}">
                    <label for="input" class="col-sm-2 control-label">Street Address:</label>
                    <div class="col-sm-10">
                        <input type="text" id="street_address"
                        name="street_address" class="form-control"
                        v-model="form.fields.street_address">
                        <span class="text-danger" v-if="form.error.has('street_address')">{{ form.error.get('street_address') }}</span>
                    </div>
                </div> <!-- ./Street Address -->

                <div class="form-group" :class="{'has-error': form.error.has('city')}">
                    <label for="input" class="col-sm-2 control-label">City:</label>
                    <div class="col-sm-10">
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
                this.$store.getters["employee/getAddress"],
                {reset: false}
            )
        };
    },

    computed: {
        address() {
            return this.$store.getters["employee/getAddress"]
        }
    },

    methods: {
        updated(event) {
            this.form.error.clear(event.target.name)
        },
        submitAddress() {
            this.form.post('/admin/employees/' + this.$store.getters["employee/getEmployee"].id + '/address')
                .then(response => {
                    this.$store.dispatch('employee/updateAddress', response.data.address)
                    // this.form.fields = response.data.address
                })
        }
    }
};
</script>

<style lang="css" scoped>
</style>