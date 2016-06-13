<template>
	<div class="navbar">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Vue Js</a>
			<ul class="nav navbar-nav">
				<li class="active" v-for="route in routes">
                    <a v-link="{ path: route.path }">{{ route.name | uppercase }}</a>
                    <!-- <a v-link="{ path: route.path }">Go to Foo</a> -->
				</li>
			</ul>
		</div>
	</div>
	<!-- /. Nav Bar -->
</template>

<script>
export default {
	data() {
		return {  
			routes: [
				{name: 'Tasks', path: '/tasks'},
				{name: 'Notes Admin', path: '/notes/admin'},
				{name: 'Notes', path: '/notes'},
			]  
		}
	}
};
</script>

<style lang="css" scoped>
</style>