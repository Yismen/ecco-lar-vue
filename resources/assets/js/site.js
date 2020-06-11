 (function(){
    document.querySelector('.more-button').addEventListener('click', function(e) {
        e.preventDefault()

        document.querySelector("#services").scrollIntoView({behavior: 'smooth'})
    })

    const observer = new IntersectionObserver(elements => {
        elements.forEach(element => {
            const animation = element.target.dataset.animation ? element.target.dataset.animation : "from-top"
            
            if(element.intersectionRatio > 0) {
                element.target.style.visibility ="visible"
                element.target.classList.add(animation)
            } else {
                element.target.style.visibility ="hidden"
                element.target.classList.remove(animation)
            }
        });
    })

    document.querySelectorAll(".animatable").forEach(element => {
        observer.observe(element)
    });
})()
