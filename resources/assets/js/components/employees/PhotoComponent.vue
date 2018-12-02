<template>
    <div class="employee-photo">

        <div class="row">
            <div class="col-sm-3 col-xs-4 text-center">            
                <img :src="'/'+photo" 
                class="img-circle img-responsive img-center profile-image animated" alt="Image" id="show-photo" with="50px">
            </div>

            <div class="col-sm-9 col-xs-8 ">

                <form class="form-horizontal" role="form"
                    @submit.prevent="submitPhoto(this)"
                    autocomplete="off" 
                    enctype="multipart/form-data"
                    @change="loadFiles"
                    @keydown="blurred">
                    
                    <div class="box-header with-border">
                        <h4>{{ employee.full_name }}' Photo:</h4>
                    </div>
            
                    <div class="box-body">
                        <div class="form-group" :class="{'has-error': form.error.has('photo')}">
                            <label for="input" class="col-sm-2 control-label">Photo:</label>
                            <div class="col-sm-10">
                                <input type="file" id="photo" 
                                    name="photo" class="form-control"
                                >
                                <span class="text-danger" v-if="form.error.has('photo')">{{ form.error.get('photo') }}</span>
                            </div>
                        </div> <!-- ./Photo -->
                    </div>
            
                    <div class="box-footer">
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-success">
                                    UPDATE PHOTO
                                </button>
                            </div>
                        </div>
                    </div>
                        
                </form>
            </div>
            
        </div>
    </div>
</template>

<script>

    export default {

        name: 'PhotoComponent',

        data () {
            return {
                form: new (this.$ioc.resolve('Form')) ({
                    photo: ''
                }, false),
                photo: this.employee.photo,
            };
        },

        props: {
            employee: {}
        },

        methods: {
            loadFiles(event) {
                this.form.loadFiles(event.target.name, event.target.files)
            },
            blurred(event) {
                this.form.error.clear(event.target.name)
            },
            submitPhoto () {
                this.form.post('/admin/employees/' + this.employee.id +'/photo')
                .then(response => {
                    console.log(response.data)
                    this.photo = response.data.photo + "?" + new Date().getTime();
                    this.employee.photo = response.data.photo;
                    // this.form.fields['photo'] = response.data.photo
                })

            }
        }
    };
</script>

<style lang="css" scoped>
</style>