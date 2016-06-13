<template>
	<div class="progress" v-show="show_loading">
	  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
	    <span class="sr-only">Loading, Please wait</span>
	  </div>
	</div>
</template>

<script>
export default {
  props: {
  	show_loading: {
  		default: false
  	},
  }
};
</script>

<style lang="css" scoped>
</style>	