
export default class Http {
    constructor(data) {
        this.data = data

        this.http = Vue.http
    }

    submit(requestType, url, data = null) {
        this.http[requestType](url, data)
            .then(response => {
                console.log(response)
            })
            .catch(error => console.log(error))
    }

    get(url) {
        this.submit('get', url)
    }

}