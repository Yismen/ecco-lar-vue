<template>
    <div class="app-component">
        <h1 class="app-header">Wlcome to Dainsys APP</h1>
    </div>
</template>

<script>
    export default {

        name: 'AppComponent',

        data () {
            return {

            };
        },

        created() {

        },

        components: {
            'navigation-view': require('./../views/NavigationView')
        }
    };
</script>

<style lang="css">
    .app-header {
        color: rgb(229, 35, 37);
    }
</style>