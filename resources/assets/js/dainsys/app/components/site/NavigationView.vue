<template>
    <div class="navigation-view">
        <ul class="nav navbar-nav navbar-default">
            <router-link tag="li" to="/">
                <a>App Home</a>
            </router-link>

            <router-link tag="li" to="/escalations">
                <a>Escalations</a>
            </router-link>
        </ul>

        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <ul class="nav navbar-nav navbar-default">
                    <router-link tag="li" to="/" exact>
                        <a><i class="fa fa-home"></i> App Home</a>
                    </router-link>

                    <router-link tag="li" to="/home" exact>
                        <a><i class="fa fa-dot-circle-o text-green"></i> Home Only</a>
                    </router-link>

                    <router-link tag="li" to="/escalations" exact>
                        <a><i class="fa fa-dot-circle-o text-green"></i> Escalations</a>
                    </router-link>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {

        name: 'NavigationView',

        data () {
            return {

            };
        },

        computed: {
            isActive (name) {
                return false;
            }
        }
    };
</script>

<style lang="css">
</style>