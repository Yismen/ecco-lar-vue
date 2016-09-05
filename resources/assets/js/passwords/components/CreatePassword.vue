<template>
    <h3 class="page-header">
        Create New Password 
        <a href="#" 
            v-link="{path:'/'}"
            class="pull-right"
        >
            <i class="fa fa-list"></i>
        </a>
    </h3>

        <form action="" method="POST" class="form-horizontal" role="form">
                <div class="form-group">
                    <legend>Form title</legend>
                </div>
        
                
        
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
        </form>
</template>

<script>
export default {

  name: 'create_password',

  data () {
    return {

    };
  }
};
</script>

<style lang="css" scoped>
</style>    