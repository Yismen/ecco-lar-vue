<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-3">
                <img :src="logo"
                    class="dainsys-logo img-responsive center-block animated" alt="Logo"
                    style="width: 215px"
                    @click="animateLogo"
                >
            </div>
        </div>
</div>
</template>

<script>

   export default {
        name: 'LogoComponent',
        props: {
            logo: {
                required: true
            },
            defaultAnimation: {
                default: 'rubberBand'
            },
            randomAnimation: {
                default: false
            }
        },

        mounted() {
            this.animateLogo()
        },

        methods: {
            animateLogo() {
                let elem = document.querySelector('.dainsys-logo')
                let current = this.getAnimation()

                elem.classList.add(current)
                setTimeout(() => { elem.classList.remove(current) }, 1000)
            },

            getAnimation() {
                if (this.wantsRandom()) {
                    let animations = [
                        'bounce', 'flash', 'pulse', 'rubberBand', 'shake', 'swing', 'tada', 'heartBeat', 'wobble', 'jello', 'bounceIn', 'fadeIn', 'flip', 'zoomIn'
                    ]

                    return animations[Math.floor(Math.random() * animations.length)]
                }
                return this.defaultAnimation

            },

            wantsRandom() {
                return this.randomAnimation
            }
        }
    };
</script>

<style lang="css" scoped>

</style>
