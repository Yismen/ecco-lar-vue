<template>
    <div class="address">
        <form class="form-horizontal" role="form"
        @submit.prevent="submitAddress"
        autocomplete="off" 
        @keydown="form.error.clear($event.target.name)">

        <div class="form-group">
            <legend>{{ employee.full_name }}' Address:</legend>
        </div>

        <div class="form-group">
            <label for="input" class="col-sm-2 control-label">Sector:</label>
            <div class="col-sm-10">
                <input type="text" id="sector" 
                name="sector" class="form-control" 
                v-model="form.fields.sector">
                <span class="text-danger" v-if="form.error.has('sector')">{{ form.error.get('sector') }}</span>
            </div>
        </div> <!-- ./Sector -->

        <div class="form-group">
            <label for="input" class="col-sm-2 control-label">Street Address:</label>
            <div class="col-sm-10">
                <input type="text" id="street_address" 
                name="street_address" class="form-control" 
                v-model="form.fields.street_address">
                <span class="text-danger" v-if="form.error.has('street_address')">{{ form.error.get('street_address') }}</span>
            </div>
        </div> <!-- ./Street Address -->

        <div class="form-group">
            <label for="input" class="col-sm-2 control-label">City:</label>
            <div class="col-sm-10">
                <input type="text" id="city" 
                name="city" class="form-control" 
                v-model="form.fields.city">
                <span class="text-danger" v-if="form.error.has('city')">{{ form.error.get('city') }}</span>
            </div>
        </div> <!-- ./City -->

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </form>
</div>
</template>

<script>

    import Form from 'jorge.form'

    export default {

      name: 'AddressComponent',

      data () {
        return {
            form: new Form({
                'sector': this.employee.addresses ? this.employee.addresses.sector : '',
                'street_address': this.employee.addresses ? this.employee.addresses.street_address : '',
                'city':this.employee.addresses ? this.employee.addresses.city : '',
            }, false)

        };
    },

    props: {
        employee: {}
    },

    methods: {
        submitAddress() {
            this.form.post('/admin/employees/updateAddress/' + this.employee.id)
                .then(response => {
                    this.employee.addresses = response.addresses;
                    return this.form.fields = response.addresses
                })
        }
    }
};
</script>

<style lang="css" scoped>
</style>