<template>
    <!-- <div v-for="i in item"> {{ i | json }} </div > -->
    <div class="col-sm-6">
         <div class="panel panel-default">
            <div class="panel-body">
                <strong>Site: </strong><a href="{{ item.url }}" target="_new">{{ item.title }}</a> 
                <a href="" @click.prevent="editPassword(item)" class="text-warning pull-right"> <i class="fa fa-pencil"></i> </a>
                <br>
                <strong>User Name: </strong>{{ item.username }} <br>
                <strong>Password: </strong><span v-show="vissible">{{ item.password }}</span> <a @click="togglePassword" class="toggler"><i class="fa fa-eye"></i></a>
                <!-- <label for="">Password: </label><input type="password" value="{{ item.password }}"> -->
            </div>
        </div>
    </div>
</template>

<script>
export default {

  name: 'password-item',

  props: ['item'], 

  data() {
    return {
       vissible: false
    }
  },

  methods: {
    togglePassword() {
        return this.vissible = !this.vissible;
    }
  },

  created() {
    // console.log(this.item)
  }
};
</script>

<style lang="css" scoped>
    .toggler {
        cursor: pointer;
    }
</style>

