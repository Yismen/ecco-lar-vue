<template>
	<!-- <div v-if="loadingResource">
		<div class="progress">
		  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
		    <span>Loading, Please wait</span>
		  </div>
		</div>
	</div> -->
	<div class="Tasks">
		<h1>
			<slot>Your</slot>'s Tasks! 
			<span v-show="tasksCount">({{ tasksCount }})</span>
			<span class="pull-right">
				<button 
					class="btn btn-success"
					@click="fetchTasks"
				>
					<i class="fa fa-refresh"></i>
				</button>
				<button 
					class="btn btn-primary"
					@click="this.$router.go('/learn/create')"
				>
					<i class="fa fa-plus"></i>
				</button>
			</span>
		</h1>

		<!-- Pending Tasks -->
		<div v-show="inProgress.length">
			<table 
				class="table table-condensed" 
				
			>
				<h3>Pending Tasks ({{ inProgress.length }})</h3>
				<tbody>
					<tr 
						v-for="task in inProgress"
						 class="animated" 
						 transition="fade"
					>
						<td>

							<div class="checkbox">
								<label 
									:class="{'task-completed':task.completed}"
									transition="completed"
								>
									<input 
										type="checkbox" 
										value="1"
										@change="changeTask(task)"
										v-model="task.completed"
									>
									{{ task.task_name }}
								</label>
							</div>						
						</td>
						<td class="col-xs-1">
							<button clas="btn btn-danger" @click="show = true">x</button>
							<modal title="Modal Title" :show.sync="show" @ok="ok" @cancel="cancel">
							    <div>Modal Body</div>

							    <div slot="header">Modal Header</div>
							    <div slot="title">Modal Title</div>
							    <div slot="footer">Modal Footer</div>
							</modal>
							<!-- <a 
								href="#"
								class="pull-right"
								@click.prevent="removeTask(task)"
							>
								<i class="fa fa-remove"></i>
							</a> -->
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<!-- Completed Tasks -->
		<div v-show="isCompleted.length">
			<h3>Completed Tasks  ({{ isCompleted.length }})

				<button 
					class="btn btn-danger pull-right"
					@click="removeCompleted"
				>
					<i class="fa fa-trash"></i>
				</button>
			</h3>
			<table 
				class="table table-condensed" 
				
			>
				 
				<tbody>
					<tr 
						v-for="task in isCompleted"
						 class="animated" 
						 transition="fade"
					>
						<td>

							<div class="checkbox">
								<label 
									:class="{'task-completed':task.completed}"
									transition="completed"
								>
									<input 
										type="checkbox" 
										value="1"
										@change="changeTask(task)"
										v-model="task.completed"
									>
									{{ task.task_name }}
								</label>
							</div>						
						</td>
						<td class="col-xs-1">
							<a 
								href="#"
								class="pull-right"
								@click.prevent="removeTask(task)"
							>
								<i class="fa fa-remove"></i>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div v-if="tasksCount">
			<div class="alert alert-info">
				<strong>No Tasks!</strong> Mo more tasks, please add some...
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		show: false,
		tasks: null,
		isCompleted: [],
		inProgress: [],
		loadingResource: {
			default: null
		},
	},

	components: {
		modal: require('./modal.vue')
	},

	computed: {
		tasksCount() {
			return this.tasks ? this.tasks.length : 0;
		},

		isCompleted() {
			if (!this.tasks) return [];

			return this.tasks.filter(function(task){
				return task.completed
			});
		},

		inProgress() {
			if (!this.tasks) return [];

			return this.tasks.filter(function(task){
				return !task.completed
			});
		}
	},

	methods: {
		fetchTasks() {
			this.loadingResource = true;

			// import some from 'vue-strap';

			// console.log(some);

			this.$http('/api/tasks')
				.then(function(success){ 

					this.loadingResource = null;
					return this.tasks = success.data.data;
				});

		},

		ok() {

		},

		cancel() {

		},

		removeCompleted() {
			var vm = this;

			bootbox.confirm({ 
			    message: "Are you sure?", 
				title: "Please proceede carefully!",
			    buttons: {
			        confirm: {
			            label: 'Delete',
			            className: 'btn-danger'
			        }
			    },
			    callback: function(result){
			    	if (result) {
						vm.$http.delete('/api/tasks/removeCompleted')
							.then(function(success){
								vm.isCompleted.filter(function(task){
									vm.tasks.$remove(task);
								});
								// vm.fetchTasks();
							});
					}
			    }
			});

		},

		removeTask(task) {
			var vm = this;

			bootbox.confirm({ 
			    message: "Are you sure?", 
				title: "Please proceede carefully!",
			    buttons: {
			        confirm: {
			            label: 'Delete',
			            className: 'btn-danger'
			        }
			    },
			    callback: function(result){
			    	if (result) {
						vm.$http.delete('/api/tasks/'+task.id)
							.then(function(success){
								vm.tasks.$remove(task);
							});
					}
			    }
			});
			
				
		},

		changeTask(task) {
			this.$http.put('/api/tasks/'+task.id, task);
		}
	},

	created() {
		this.fetchTasks();
		
	}


};
</script>

<style lang="css" scoped>
	.Tasks .task-completed {
		color: #cacaca;
		text-decoration: line-through;
	}

	
</style>