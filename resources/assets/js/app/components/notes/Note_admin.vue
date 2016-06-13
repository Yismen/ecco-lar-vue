<template>
	<!-- <skew-loader :loading="loading"></skew-loader> -->
	<div class="row">
		<div class="col-sm-4">
			<form method="POST" role="form" @submit.prevent="updateNote()">
				<legend>Notes</legend>
			
				<div class="form-group">
					<label for="title">Note Title:</label>
					<input 
						type="text" 
						class="form-control" 
						id="title" 
						placeholder="Input field"
						v-model="newNote.title"
					>
				</div>
			
				<div class="form-group">
					<label>Note Content:</label>
					<textarea 
						name="body" 
						id="body" 
						cols="30" 
						rows="10" 
						class="form-control"
						v-model="newNote.body"
					></textarea>
				</div>
			
				<div class="form-group">
					<label for="title">Tags:</label>
					<input 
						type="text" 
						class="form-control" 
						id="tags" 
						placeholder="Input field"
						v-model="newNote.tags"
					>
					<span class="help-block">Use commas to separate tags</span>
				</div>
			
				<button 	
					class="btn btn-primary" 
					@click.prevent="create"
					v-if="!newNote.updating"
				>Create</button>
				
				<button 
					type="submit" 
					v-if="newNote.updating"
					class="btn btn-default"
					@click.prevent="cancelUpdate"
				>Cancel</button>
				
				<button 
					type="submit" 
					v-if="newNote.updating"
					class="btn btn-info"
					@click.prevent="updateNote()"
				>Update</button>
			</form>
		</div>
		<!-- /. Form -->
		<div class="col-sm-8">			
			<notelist :list="notes" admin="true"></notelist>
		</div>
		<!-- /. Results -->
	</div>
</template>

<script>
export default {
  data () {
    return {
    	notes: [],
    	searchNote: null,
    	loading: false,
    	newNote: {index:null, title: null, body: null, updating: null}
    };
  },

  components: {
  	notelist: require('./_list.vue'),
        PulseLoader: require('vue-spinner/dist/vue-spinner.min'),
  },

  methods: {
  	resetNotes() {
  		return this.newNote = {index:null, title: null, body: null, updating: null};
  	},

  	fetchNotes() {
  		this.loading = true;
  		this.$http('/api/notes/admin')
  			.then(function(response){
  				this.notes = response.data;
  				// this.loading = false;
  			});
  	},

  	create() {
  		this.$http.post('/api/notes/admin', this.newNote)
  			.then(function(response){
  				this.notes.push(response.data);
  				this.resetNotes();
  			});
  		
  	},

  	updateNote() {
  		var note = this.newNote;
  		this.$http.put('/api/notes/admin/'+note.slug, note)
  			.then(function(response){
  				this.notes.$set(note.index, response.data);
  				this.resetNotes();
  			});
  		document.getElementById('title').focus();
  	},

  	cancelUpdate() {
  		this.resetNotes();
  	}

  	
  },

  created() {
  	this.fetchNotes();
  }
};
</script>

<style lang="css" scoped>
</style>