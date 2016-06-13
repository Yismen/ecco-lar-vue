<template>
	<form action="#" method="POST" role="form" @submit.prevent="createTask">
		<legend>Create Task</legend>
	
		<div class="form-group">
			<label for="">Task:</label>
			<input 
				type="text" 
				class="form-control" 
				id="" 
				placeholder="Input field"
				v-model="newTask.task_name"
			>
		</div>	
	
		<button type="submit" class="btn btn-primary" @click.prevent="createTask">Create</button>
	</form>
</template>

<script>
export default {
  data () {
    return {

    	newTask: {
    		task_name: ''
    	}

    };
  },

  methods: {
  	createTask() {

  		// return console.log(this.newTask)
  		this.$http.post('/api/tasks', {task_name: this.newTask.task_name})
  			.then(function(response){
  				this.newTask.task_name = '';
  				this.$router.go('/learn');
  				// console.log(response);
  			});
  	}
  }
};
</script>

<style lang="css" scoped>
</style>