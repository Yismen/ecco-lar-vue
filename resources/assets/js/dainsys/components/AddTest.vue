<template>
    <div class="test">
        <h3>Add Test</h3>

        <form @submit.prevent="handleForm"
            autocomplete="off" 
            @keydown="form.error.clear($event.target.name)"
            @change="form.error.clear($event.target.name)">
            
            <div class="form-group">
                <input type="text" class="form-control" 
                    name="name" v-model="form.fields.name">

                <span class="text-danger" v-if="form.error.has('name')">{{ form.error.get('name') }}</span>
            </div>
            
            <div class="form-group">
                <input type="text" class="form-control" 
                    name="body" v-model="form.fields.body">

                <span class="text-danger" v-if="form.error.has('body')">{{ form.error.get('body') }}</span>
            </div>

            <button type="submit" class="btn btn-primary"
                :disabled="form.error.any()">Submit</button>

        </form>
    </div>
</template>

<script>
    import Form from '../vendor/jorge.form';

    export default {

        name: 'AddTest',

        data () {
            return {
                form: new Form({
                    name: '',
                    body: ''
                })
            };
        }, 

        methods: {
            handleForm() {
                this.form.post('/admin/api/test-vue')
                    .then(response => this.$emit('add-user', response))
                    .catch(error => console.log(error))
            }
        }
    };
</script>

<style lang="css" scoped>
</style>