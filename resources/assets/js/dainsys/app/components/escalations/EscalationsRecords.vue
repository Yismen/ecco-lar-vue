<template>
    <div class="escalations_records">
        <create-record></create-record>
        <hr>
        <div class="row">
            <div class="col-sm-4">
                <h3>
                    Total Records: <span class="label label-success">{{ counter }}</span>
                </h3>
            </div>
            <div class="col-sm-8">
                <div class="input-group"
                    v-bind:class="{'has-error': searchForm.error.has('search')}">
                    <div class="col-sm-12">
                        <form method="POST"
                          autocomplete="off"
                          @keydown="searchForm.error.clear($event.target.name)"
                          @submit.prevent="searchBackend"
                        >
                          <span class="input-group-btn">
                              <input type="text" name='search' class="form-control" v-model="searchForm.fields.search">
                              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                          </span>
                        <span v-if="searchForm.error.has('search')" 
                            class="text-danger" v-text="searchForm.error.get('search')"></span>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover table-condensed table-bordered">
                <thead>
                    <tr>
                        <th>Tracking Number:</th>
                        <th>Client Name:</th>
                        <th>Action:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="record in shared.records | filterBy searchForm.fields.search in 'tracking' 'escal_client.name'">
                        <td>{{ record.tracking }}</td>
                        <td>{{ record.escal_client.name }}</td>
                        <td>
                          <a href="/admin/escalations_records/{{ record.tracking }}/edit">
                              <i class="fa fa-edit"></i>
                               Edit
                          </a>                           
                        </td>
                    </tr>
                </tbody>
            </table>
            <paginate  
              v-bind:pagination="pagination"
              @click.native="fetchRecords(pagination.current_page)"></paginate>
        </div>

    </div>
</template>

<script>
    import shared from './../stores/EscalationsRecords.js';
    import Form from '../../vendor/jorge.form'
    import CreateRecords from './CreateRecords.vue';
    import Paginate from './../core/Pagination.vue';

export default {

  name: 'EscalationsRecords',

  data () {
    return {
        shared: shared,
        counter: 0,
        searchForm: new Form({
          search: ''
        }),
        editForm: false,
        pagination: {
        }
    };
  },

  components: {
    CreateRecords, Paginate,
  },

  props: {
  },

  computed: {
    totalRecords: function() {
        return this.shared.records.length;
    }
  },

  methods: {
    fetchRecords(page) {
        if (this.totalRecords == 0 || page) {
            return this.$http.get('/admin/api/escalations_records?page='+page)
                .then(function(response){
                  this.$set('pagination', response.data);
                  this.$set('counter', response.data.total);
                  // Toast({
                  //   message: 'Upload Completed'
                  // })
                return this.shared.records = response.data.data;
            });
        }
    },

    searchBackend() {
      return this.$http.post('/admin/api/escalations_records/search', this.searchForm.fields)
        .then(function(response){
            Toast({
              message: 'Upload Completed'
            })
            return this.shared.records = response.data;
        }).catch(function(errors) {
            return this.searchForm.error.record(errors.data);            
        });
    },
    editRecord(record) {
      this.editForm = true;
      console.log("Edit: ", record.id)
    }
  },

  events: {
    'record-created': function(record) {
        this.counter = this.counter + 1;
        this.shared.records.unshift(record);
    },
    'record-updated': function(record) {
      // this.records.$set()
      this.shared.records.unshift(record);
    },
    'show-create-form': function() {
      this.editForm = false;
    }
  },

  created() {
    // document.querySelector('input')[0]
    this.fetchRecords(this.pagination.current_page);
  }
};
</script>

<style lang="css" scoped>
</style>