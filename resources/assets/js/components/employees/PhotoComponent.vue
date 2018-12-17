<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-aqua-active">
                    <h3>{{ employee.full_name }}</h3>
                    <h4>
                        Photo Info
                        <a :href="photo" target="_employee_photo" class="view-photo">
                            <i class="fa fa-eye"></i> Ver
                        </a>
                    </h4>
                </div>

                <div class="widget-user-image">
                    <img :src="photo"
                        class="img-circle"
                    >
                </div>

                <div class="box-footer">
                    <form class="form-horizontal" role="form"
                        @submit.prevent="submitPhoto(this)"
                        autocomplete="off"
                        enctype="multipart/form-data"
                        @change="loadFiles"
                        @keydown="blurred"
                    >

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
    </div>
</template>

<script>

    export default {

        name: 'PhotoComponent',

        data () {
            return {
                form: new (this.$ioc.resolve('Form')) ({
                    photo: ''
                }, false)
            };
        },

        computed: {
            employee() {
                return this.$store.getters['employee/getEmployee']
            },
            photo() {
                let time = new Date().getTime()
                return String(this.employee.photo).substring(0,7).toLowerCase() == "storage" ?
                    '/' + this.employee.photo + '?' + time  :
                    this.employee.photo + '?' + time
            }
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
                        this.$store.dispatch('employee/set', response.data)
                    })

            }
        }
    };
</script>

<style lang="css" scoped>
    .view-photo {
        color: #fafafa;
        font-weight: bold;
    }
</style>