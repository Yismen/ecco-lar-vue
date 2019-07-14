export const API_ROUTE = "/api/" // https://routetoapi.com/api


export const DAINSYS = {
    colors() {
        return {
            primary: "rgba(63,81,181,1)",
            info: "rgba(33,150,243,1)",
            success: "rgba(0,150,136,1)",
            danger: "rgba(244,67,54,1)",
            warning: "rgba(255,193,7,1)",
            female: "rgba(233,30,99,1)",

        }
    },
    getColors() {
        return [
            "rgba(0,150,136 ,1)",
            "rgba(33,150,243 ,1)",
            "rgba(156,39,176 ,1)",
            "rgba(244,67,54 ,1)",
            "rgba(255,193,7 ,1)",
            "rgba(255,87,34 ,1)",

            "rgba(229,115,115 ,1)",
            "rgba(186,104,200 ,1)",
            "rgba(100,181,246 ,1)",
            "rgba(77,182,172 ,1)",
            "rgba(255,213,79 ,1)",
            "rgba(255,138,101 ,1)",

            "rgba(0,150,136 ,1)",
            "rgba(33,150,243 ,1)",
            "rgba(156,39,176 ,1)",
            "rgba(244,67,54 ,1)",
            "rgba(255,193,7 ,1)",
            "rgba(255,87,34 ,1)",

        ]
    },

    getRamdonElement(array) {

        return array[Math.floor(Math.random()*array.length)]
    },

    shuffleArray(array) {
        for (var i = array.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1));
            var temp = array[i];
            array[i] = array[j];
            array[j] = temp;
        }
        return array
    }
}

export default API_ROUTE
