<template>
    <div class="well">
        <form method="POST"
            class="form-horizontal"
            role="form"
            autocomplete="off"
            @submit.prevent="submitForm"
            @keydown="form.error.clear($event.target.name)"
            @change="form.error.clear($event.target.name)">
                <legend>Create a New Escalations Record</legend>
                        
                <!-- @include('escalations_records._form') -->

                <!-- Tracking # -->
                <div class="form-group"
                    v-bind:class="{'has-error': form.error.has('tracking')}">
                    <label for="tracking" class="col-sm-2 control-label">Tracking #</label>
                    <div class="col-sm-10">
                        <input 
                            type="text" name="tracking" 
                            class="form-control" id="tracking" 
                            v-model="form.fields.tracking">
                        <span v-if="form.error.has('tracking')" class="text-danger" v-text="form.error.get('tracking')"></span>
                    </div>
                </div>

                <div class="form-group" 
                    v-bind:class="{'has-error': form.error.has('escalations_client_id')}">
                    <label for="" class="col-sm-2 control-label">Client:</label>
                    <div class="col-sm-10">
                        <select name="escalations_client_id" 
                            id="escalations_client_id" 
                            class="form-control" 
                            v-model="form.fields.escalations_client_id">
                            <option value="" selected="selected"><-- Please select one --></option>
                            <option value="{{ client.id }}" v-for="client in clients"> {{ client.name }} </option>
                        </select>
                        <span v-if="form.error.has('escalations_client_id')" class="text-danger" v-text="form.error.get('escalations_client_id')"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                        <button class="btn btn-primary" type="submit" :disabled="form.error.any()"><i class="fa fa-floppy-o"></i> SAVE</button>
                        <button class="btn btn-default" type="reset"><i class="fa fa-refresh"> </i> Reset Form</button>
                    </div>
                </div>
            </form>
    </div>
</template>

<script>
import Form from '../../../vendor/jorge.form'

export default {
    name: 'CreateRecords',
  data () {
    return {
        clients: [],
        form: new Form({
            'tracking': '',
            'escalations_client_id': '',
        })
    };
  }, 
  methods: {
    fetchClients() { 
        return this.$http.get('/admin/api/escalations_records/clients').then(function(response){
            return this.clients = response.data;
        });
    },
    submitForm() {
        return this.$http.post('/admin/api/escalations_records', this.form.fields)
            .then(function(response) {
                this.form.resetField('tracking');
                // Toast.info('Record ' + response.data.tracking + " created");
                return this.$dispatch('record-created', response.data);
            }).catch(function(errors) {
                return this.form.error.record(errors.data);            
            });
    }
  },

  computed: {

  },

  created() {
    return this.fetchClients();
  }
};
</script>

<style lang="css" scoped>
</style>    