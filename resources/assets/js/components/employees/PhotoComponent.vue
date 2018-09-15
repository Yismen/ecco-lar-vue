<template>
    <div class="employee-photo">

        <div class="row">
            <div class="col-sm-3 col-xs-4 text-center">            
                <img :src="photo" 
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
                        <div class="form-group">
                            <label for="input" class="col-sm-2 control-label">Photo:</label>
                            <div class="col-sm-10">
                                <input type="file" id="photo" 
                                    name="photo" class="form-control"  
                                >
                                <span class="text-danger" v-if="form.error.has('photo')">{{ form.error.get('photo') }}</span>
                            </div>
                        </div> <!-- ./Photo -->
                    </div>
            
                    <div class="box-footer" v-if="showButton">
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

    import Form from '../../../vendor/jorge.form'

    export default {

        name: 'PhotoComponent',

        data () {
            return {
                form: new Form({photo3: ''}, false),
                photo: this.employee.photo,
                showButton: false
            };
        },

        props: {
            employee: {}
        },

        methods: {
            loadFiles(event) {
                this.showButton = true
                this.form.loadFiles(event.target.name, event.target.files)
            },
            blurred(event) {
                this.showButton = true
                this.form.error.clear(event.target.name)
            },
            submitPhoto () {
                this.form.post('/admin/employees/updatePhoto/' + this.employee.id)
                .then(response => {
                    this.photo = response.photo;
                    this.employee.photo = response.photo;
                    this.showButton = false
                    return this.form.fields = response
                })

            }
        }
    };
</script>

<style lang="css" scoped>
</style>