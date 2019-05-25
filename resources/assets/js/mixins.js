const MIXINS = {
    methods: {
        animateLogo() {
            let elem = document.querySelector('.dainsys-logo')
            let animations = ['bounce', 'flash', 'pulse', 'rubberBand', 'shake', 'swing', 'tada', 'heartBeat']
            let current = animations[Math.floor(Math.random() * animations.length)]

            elem.classList.remove('heartBeat')
            elem.classList.remove(current)
            elem.classList.add(current)
            setTimeout(() => { elem.classList.remove(current) }, 1000)
        }
    }
}

export default MIXINS