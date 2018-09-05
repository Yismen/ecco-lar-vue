<template>
    <div class="_LoadingComponent">
        <div v-if="show" class="spinner">
            <div class="inner one"></div>
            <div class="inner two"></div>
            <div class="inner three"></div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    
    export default {

        name: 'LoadingComponent',
        computed: mapState({
            show: state => state.loading.showSpinner
        })
    };
</script>

<style lang="css" scoped>

    .spinner{
        height: 150px;
        width: 150px;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        z-index: 1000;
    }
    /* Transparent Overlay */
    .spinner:before {
        content: '';
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.1);
    }


    .inner{
        height: 150px;
        width: 150px;
        display: block;
        position: absolute;
        border-radius: 100%;
        opacity: 0.7;
        box-sizing: border-box;
    }
    .spinner>.one{
        border: 6px solid transparent;
        border-top-color: #27ae60;
        border-bottom-color: #27ae60;
        animation: rotate 2s ease infinite;
    }
    .spinner>.two{
        border: 9px solid transparent;
        border-top-color: #d35400;
        border-bottom-color: #d35400;
        animation: rotate 4s ease infinite;
    }
    .spinner>.three{
        border: 12px solid transparent;
        border-top-color: #8e44ad;
        border-bottom-color: #8e44ad;
        animation: rotate 7s ease infinite;
    }
    @keyframes rotate{
        from{-webkit-transform: rotate(-180deg);
            -moz-transform: rotate(-180deg);
            -ms-transform: rotate(-180deg);
            -o-transform: rotate(-180deg);
            transform: rotate(-180deg);
        };
        to{-webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
</style>
