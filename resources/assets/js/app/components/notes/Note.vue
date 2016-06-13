<template>
	<div class="row">
		<notelist :list="notes"></notelist>
		
		<!-- /. Results -->
	</div>
</template>

<script>
export default {

  data () {
    return {
    	notes: [],
    	searchNote: null
    };
  },

  components: {
  	notelist: require('./_list.vue')
  },

  methods: {
  	fetchNotes() {
  		this.$http('/api/notes/admin')
  			.then(function(response){
  				this.notes = response.data;
  			});
  	}
  },

  created() {
  	this.fetchNotes();
  }
};
</script>

<style lang="css" scoped>
</style>