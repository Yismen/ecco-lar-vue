<template>
    <div class="_Edit">
        <form role="form"
            @submit.prevent="handleEdit"
            autocomplete="off" 
            @keydown="form.error.clear($event.target.name)">

            <div class="box-header with-border">
                <h4>Edit {{ employee.full_name }}' General Information</h4>
            </div>
    
            <div class="box-body">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="first_name" class="">First Name:</label>
                        <input type="text" id="first_name" 
                        name="first_name" class="form-control input-sm" 
                        v-model="form.fields.first_name">
                        <span class="text-danger" v-if="form.error.has('first_name')">{{ form.error.get('first_name') }}</span>
                    </div>                 
                </div> <!-- ./First Name-->

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="second_first_name" class="">Second First Name:</label>
                        <input type="text" id="second_first_name" 
                        name="second_first_name" class="form-control input-sm" 
                        v-model="form.fields.second_first_name">
                        <span class="text-danger" v-if="form.error.has('second_first_name')">{{ form.error.get('second_first_name') }}</span>
                    </div>                 
                </div> <!-- ./Second First Name-->

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="last_name" class="">Last Name:</label>
                        <input type="text" id="last_name" 
                        name="last_name" class="form-control input-sm" 
                        v-model="form.fields.last_name">
                        <span class="text-danger" v-if="form.error.has('last_name')">{{ form.error.get('last_name') }}</span>
                    </div>                 
                </div> <!-- ./Last Name-->

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="second_last_name" class="">Second Last Name:</label>
                        <input type="text" id="second_last_name" 
                        name="second_last_name" class="form-control input-sm" 
                        v-model="form.fields.second_last_name">
                        <span class="text-danger" v-if="form.error.has('second_last_name')">{{ form.error.get('second_last_name') }}</span>
                    </div>                 
                </div> <!-- ./Second Last Name-->

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="personal_id" class="">Personal ID:</label>
                        <input type="text" id="personal_id" 
                        name="personal_id" class="form-control input-sm" 
                        v-model="form.fields.personal_id">
                        <span class="text-danger" v-if="form.error.has('personal_id')">{{ form.error.get('personal_id') }}</span>
                    </div>                 
                </div> <!-- ./Personal ID-->

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="passport" class="">Or Passport:</label>
                        <input type="text" id="passport" 
                        name="passport" class="form-control input-sm" 
                        v-model="form.fields.passport">
                        <span class="text-danger" v-if="form.error.has('passport')">{{ form.error.get('passport') }}</span>
                    </div>                 
                </div> <!-- ./Or Passport-->

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="hire_date" class="">Hire Date:</label>
                        <datepicker input-class="form-control input-sm" 
                            v-model="form.fields.hire_date" 
                            name="hire_date" 
                            format="MM/dd/yyyy" 
                        ></datepicker>
                        <span class="text-danger" v-if="form.error.has('hire_date')">{{ form.error.get('hire_date') }}</span>
                    </div>                 
                </div> <!-- ./Hire Date-->

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="date_of_birth" class="">Date of Birth:</label>
                        <datepicker input-class="form-control input-sm" 
                            name="date_of_birth"                            
                            v-model="form.fields.date_of_birth" 
                            format="MM/dd/yyyy" 
                        ></datepicker>
                        <span class="text-danger" v-if="form.error.has('date_of_birth')">{{ form.error.get('date_of_birth') }}</span>
                    </div>                 
                </div> <!-- ./Date of Birth-->

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="cellphone_number" class="">Cellphone Number:</label>
                        <input type="text" id="cellphone_number" 
                        name="cellphone_number" class="form-control input-sm" 
                        v-model="form.fields.cellphone_number">
                        <span class="text-danger" v-if="form.error.has('cellphone_number')">{{ form.error.get('cellphone_number') }}</span>
                    </div>                 
                </div> <!-- ./Cellphone Number-->

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="secondary_phone" class="">Secondary Phone #:</label>
                        <input type="text" id="secondary_phone" 
                        name="secondary_phone" class="form-control input-sm" 
                        v-model="form.fields.secondary_phone">
                        <span class="text-danger" v-if="form.error.has('secondary_phone')">{{ form.error.get('secondary_phone') }}</span>
                    </div>                 
                </div> <!-- ./Secondary Phone #-->            

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="gender_id" class="">Gender:</label>
                        <select name="gender_id" id="gender_id" class="form-control" v-model="form.fields.gender_id">
                            <option v-for="(gender_id, index) in employee.genders_list" :value="index">{{ gender_id }}</option>
                        </select>
                        <span class="text-danger" v-if="form.error.has('gender_id')">{{ form.error.get('gender_id') }}</span>
                    </div>                 
                </div> <!-- ./Gender-->         

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="marital_id" class="">Marital Status:</label>
                        <select name="marital_id" id="marital_id" class="form-control" v-model="form.fields.marital_id">
                            <option v-for="(marital_id, index) in employee.maritals_list" :value="index">{{ marital_id }}</option>
                        </select>
                        <span class="text-danger" v-if="form.error.has('marital_id')">{{ form.error.get('marital_id') }}</span>
                    </div>                 
                </div> <!-- ./Marital Status-->      

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="has_kids" class="">Has Kids?:</label>
                        <select name="has_kids" id="has_kids" class="form-control" v-model="form.fields.has_kids">
                            <option v-for="(has_kids, index) in employee.has_kids_list" :value="index">{{ has_kids }}</option>
                        </select>
                        <span class="text-danger" v-if="form.error.has('marital_id')">{{ form.error.get('has_kids') }}</span>
                    </div>                 
                </div> <!-- ./Has Kids-->   

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="position_id" class="">Position:</label>
                        <select name="position_id" id="position_id" class="form-control" v-model="form.fields.position_id">
                            <option v-for="position in employee.positions_list" :value="position.id">{{ position.name_and_department }}</option>
                            <!-- <option v-for="(position_id, index) in employee.positions_list" :value="index">{{ position_id }}</option> -->
                        </select>
                        <span class="text-danger" v-if="form.error.has('marital_id')">{{ form.error.get('position_id') }}</span>
                    </div>                 
                </div> <!-- ./Position-->
            </div>
    
            <div class="box-footer">
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-success">
                            UPDATE
                        </button>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
</template>

<script>

    import Form from '../../../vendor/jorge.form'
    import datepicker from 'vuejs-datepicker'

    export default {

      name: 'EditInfoComponent',

      data () {
        return {
            form: new Form({
                'first_name': this.employee ? this.employee.first_name : '',
                'second_first_name': this.employee ? this.employee.second_first_name : '',
                'last_name': this.employee ? this.employee.last_name : '',
                'second_last_name': this.employee ? this.employee.second_last_name : '',
                'personal_id': this.employee ? this.employee.personal_id : '',
                'passport': this.employee ? this.employee.passport : '',
                'hire_date': this.employee ? this.employee.hire_date : '',
                'date_of_birth': this.employee ? this.employee.date_of_birth : '',
                'cellphone_number': this.employee ? this.employee.cellphone_number : '',
                'secondary_phone': this.employee ? this.employee.secondary_phone : '',
                'gender_id': this.employee ? this.employee.gender_id : '',
                'marital_id': this.employee ? this.employee.marital_id : '',
                'has_kids': this.employee ? this.employee.has_kids : '',
                'position_id': this.employee ? this.employee.position_id : '',
            }, false)

        };
    },

    props: {
        employee: {}
    },

    components: {
        datepicker
    },

    filters: {
    },

    created() {
        // console.log(this.employee.positions_list)
        // this.employee.positions_list = this.sortByProperties(this.employee.positions_list);
        // console.log(this.employee.positions_list)
    },

    methods: {
        sortByProperties(obj) {
      
        // convert object into array
        var sortable=[];
        for(var key in obj)
            if(obj.hasOwnProperty(key)) {
                sortable.push([key, obj[key]]); // each item is an array in format [key, value]
            }
                

            // sort items by value
            sortable.sort(function(a, b) {
                var x=a[1].toLowerCase(),
                y=b[1].toLowerCase();
                return x<y ? -1 : x>y ? 1 : 0;
            });

            let sortedObject = [];
            for (var i = 0; i < sortable.length; i++) {

                let key = sortable[i][0];
                let value = sortable[i][1];
                sortedObject[key] = value;
            }
            return sortedObject; // array in format [ [ key1, val1 ], [ key2, val2 ], ... ]

        },

        handleEdit() {
            this.form.put('/admin/employees/' + this.employee.id)
                .then(response => {
                    this.employee = response;
                    return this.form.fields = response;
                })
        }
    }
};
</script>

<style lang="css" scoped>
</style>