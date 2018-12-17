<template>
    <div class="_create_positions">
        <a href="#"
            @click.prevent="$modal.show('create-position')"
        >
            <i class="fa fa-plus"></i>
            Add
        </a>
        <modal name="create-position" height="auto" :scrollable="true" @opened="modalOpened">
             <form role="form" class="form-horizontal"
                @submit.prevent="createNew"
                autocomplete="off"
            >
                <div class="box-header with-border">
                    <h4>Create Position</h4>
                </div>

                <div class="box-body">

                    <div class="form-group" :class="{'has-error': form.error.has('name')}">
                        <div class="">
                            <label for="name" class="col-sm-3 control-label">Name:</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" id="create-position-name"
                                            name="name" class="form-control"
                                            v-model="form.fields.name"
                                        >
                                        <div class="input-group-addon"><i class="fa fa-flag"></i></div>
                                    </div>
                                <span class="text-danger" v-if="form.error.has('name')">{{ form.error.get('name') }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- /. Name -->

                    <div class="form-group" :class="{'has-error': form.error.has('department_id')}">
                        <label for="input" class="col-sm-3 control-label">Department:</label>
                        <div class="col-sm-9">
                            <select name="department_id" id="department_id" class="form-control" v-model="form.fields.department_id">
                                <option v-for="(department, index) in departments"
                                    :value="department.id"
                                    :key="index"
                                >{{ department.department }}</option>
                            </select>
                            <span class="text-danger" v-if="form.error.has('department_id')">{{ form.error.get('department_id') }}</span>
                        </div>
                    </div>
                    <!-- ./Department-->

                    <div class="form-group" :class="{'has-error': form.error.has('payment_type_id')}">
                        <label for="input" class="col-sm-3 control-label">Payment Type:</label>
                        <div class="col-sm-9">
                            <select name="payment_type_id" id="payment_type_id" class="form-control" v-model="form.fields.payment_type_id">
                                <option v-for="(payment_type, index) in paymentTypes"
                                    :value="payment_type.id"
                                    :key="index"
                                >{{ payment_type.name }}</option>
                            </select>
                            <span class="text-danger" v-if="form.error.has('payment_type_id')">{{ form.error.get('payment_type_id') }}</span>
                        </div>
                    </div>
                    <!-- ./Paymen Type-->

                    <div class="form-group" :class="{'has-error': form.error.has('payment_frequency_id')}">
                        <label for="input" class="col-sm-3 control-label">Payment Frequency:</label>
                        <div class="col-sm-9">
                            <select name="payment_frequency_id" id="payment_frequency_id" class="form-control" v-model="form.fields.payment_frequency_id">
                                <option v-for="(payment_frequency, index) in paymentFrequencies"
                                    :value="payment_frequency.id"
                                    :key="index"
                                >{{ payment_frequency.name }}</option>
                            </select>
                            <span class="text-danger" v-if="form.error.has('payment_frequency_id')">{{ form.error.get('payment_frequency_id') }}</span>
                        </div>
                    </div>
                    <!-- ./Paymen Type-->

                    <div class="form-group" :class="{'has-error': form.error.has('salary')}">
                        <div class="">
                            <label for="salary" class="col-sm-3 control-label">Salary:</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="number" id="create-position-salary"
                                            name="salary" class="form-control"
                                            v-model="form.fields.salary"
                                        >
                                        <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                    </div>
                                    <span class="text-danger" v-if="form.error.has('salary')">{{ form.error.get('salary') }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- /. Salary -->

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">CREATE</button>
                </div>

            </form>
        </modal>
    </div>
</template>

<script>

export default {
    name: "CreatePositionComponent",

    data() {
        return {
            form: new (this.$ioc.resolve('Form')) ({
                name: '',
                department_id: '',
                payment_type_id: '',
                payment_frequency_id: '',
                salary: '',
            }),

        }
    },

    props: {
        departments_list: {required: true},
        payment_types_list: {required: true},
        payment_frequencies_list: {required: true}
    },

    computed: {
        departments() {
            return this.departments_list
        },

        paymentTypes() {
            return this.payment_types_list
        },

        paymentFrequencies() {
            return this.payment_frequencies_list
        }
    },

    methods: {
        modalOpened(e) {
            this.setFocusOnFirstElement(e)
        },

        createNew() {
            this.form.post('/api/positions')
                .then(response => {
                    this.$emit('position-created', response.data)
                    this.form.fields.name = '';
                    this.$modal.hide('create-position');
                })
        },

        setFocusOnFirstElement(e) {
            let inputs = e.ref.getElementsByTagName("input")
                if (inputs.length > 0) {
                    inputs[0].focus()
                }
        }
    }
}
</script>

<style>

</style>
