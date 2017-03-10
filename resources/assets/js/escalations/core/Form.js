let Error = require('./Error.js');
let Http = Vue.http;
let Toast = require('v-toast').default;;
export default class Form {
    constructor (data) {
        this.originalData = data;
        this.fields = {}

        for (let field in data) {
            this.fields[field] = data[field];
        }

        this.error = new Error();

        this.toast = Toast;

        this.http = Http;
    }

    submit(requestType, url) {
        requestType = requestType.toLowerCase();
        let vm = this;
        return this.http[requestType](url, vm.fields)
            // .then(this.onSuccess.bind(this))
            .catch(this.onFail.bind(this));
    }

    onSuccess(response) {
        this.toast.success({message: "Process sucessful!", duration: 5000});
        this.error.clear();
        return response;
    }

    onFail(errors) {
        this.toast.error({message: "There are errors on the form!", duration: 5000});
        this.error.record(errors.data);
    }

    get(url) {
        return this.submit('get', url);
    }

    post(url) {
        return this.submit('post', url);
    }

    put(url) {
        return this.submit('put', url);
    }

    delete(url) {
        return this.submit('delete', url);
    }

    resetField(field) {
        this.fields[field] = '';
    }

    reset(field) {
        if (field) { 
            return this.fields[field] = '';
        }

        for(let field in this.fields) {
            this.fields[field] = '';
        }
    }

    // reset(fieldsArray) {
    //     let fields = this.fields;
    //     if (fieldsArray) {
    //         fields = fieldsArray;
    //     } 

    //     for(let field in fields) {
    //         console.log(field)
    //         this.fields[field] = '';
    //     }
    // }
}