<template>
	<div class="col-sm-12" v-if="list.length">
		<div class="input-group">
			<input 
				type="text" 
				class="form-control" 
				id="exampleInputAmount" 
				placeholder="Search Note"
				v-model="searchNote"
			>
			<div class="input-group-addon"><i class="fa fa-search"></i></div>
		</div>
		<div class="col-sm-12 "><!-- pre-scrollable -->
			<div v-for="note in list | filterBy searchNote"
				class="animated" 
				transition="fade"
			>
				<h3>
					{{ note.title }}
					<div v-if="admin">
						<a href=""
							class="pull-right "
							@click.prevent="removeNote(note)"
							style="margin: 0 10px ;"
						>
							<small class="text-danger"><i class="fa fa-remove"></i></small>
						</a>

						<a href=""
							class="pull-right"
							@click.prevent="editNote(note, $index)"
						>
							<small><i class="fa fa-pencil"></i></small>
						</a>
					</div>
				</h3>
				<!-- /. Title -->

				<p>{{{ note.body }}}</p>
					<!-- parseTag(note.tags) -->
				<p v-if="note.tags">
					<strong>Tags: </strong>
					<span 
						style="margin-right: 3px;"
						class="label label-info"
						v-for="tag in note.tag_list"
					>{{ tag }}</span>
				</p>

				<hr>

			</div >
		</div>
	</div>
</template>
 
 <script>
 export default {

 	data() { 		
    	return {
    		searchNote: null
    	}
 	},
 
   props: {
 	list: [],
 	admin: {default: false}
   }, 

   methods: {
   	editNote(note, index) {
   		// console.log(note, index)
   		this.$parent.newNote = note;
   		this.$parent.newNote.index = index;
   		this.$parent.newNote.updating = true;
   		document.getElementById('title').focus();
  	},	

  	removeNote(note) {
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
					vm.$http.delete('/api/notes/admin/'+note.slug)
						.then(function(success){
							vm.list.$remove(note);
						});
				}
		    }
		});
  	}

   }
 };
 </script>
 
 <style lang="css" scoped>
 </style> 