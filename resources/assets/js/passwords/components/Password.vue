<template>
    <div class="table-responsive">
        <h4 class="page-header">
            Passwords Management 
            <a href="#" v-link="{path:'/create'}" 
                class="pull-right"
                title="Create Password" 
            >
                <i class="fa fa-plus"></i>
            </a> 
        </h4>
        <div v-if="passwords.length > 0">
            <div v-for="password in passwords">
                <password-item :item="password"></password-item>                                       
            </div>
        </div>
        <div v-else>
            <div class="alert">
                <h3>Nothing saved yet. Please add some passwords.</h3>
            </div>
        </div>
    </div>
</template>

<script>
export default {

  name: 'passwords',

  data () {
    return {
        passwords: [],
        creating: true,
        password: [],
    };
  },

  components: {
    'password-item': require('./PasswordItem.vue'),
  },

  props: {
  },

  methods: {
    createPassword(manage){
        console.log('create', manage)
        return this.creating = true;
    },

    editPassword(object){
        console.log("edit ", object);
        return this.creating = false;
    },

    getData() {
        return this.$http.get('/api/passwords').then(function(response){
            // console.log(response)
            return this.passwords = response.data;
        }, function(reject){
            console.log(reject)
        });
    }
  },

  created() { 
    this.getData();
  }
};
</script>

<style lang="css" scoped>
</style>