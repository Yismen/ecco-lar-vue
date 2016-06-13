<template>
	<!-- Requires bootbox.js to be installed -->
	<button
		class="btn btn-{{ type }}"
		@click="bootBox"
	>
		<slot>
			Delete
		</slot>
	</button>
</template>

<script>
export default {

  data () {
    return {
    };
  }, 

  props: {
  	type: {default: 'danger'},

  	confirmed: false
  }
};
</script>

<style lang="css" scoped>
</style>