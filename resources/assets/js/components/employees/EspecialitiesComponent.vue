<template>
    <div class="_Supervisor well">
        <div class="box-header with-border">
            <h4>Especialities:</h4>
        </div>

        <div class="box-body">
            <div class="form-group col-md-6">
                <div class="col-xs-6" :class="{'bg-success': isVip}">                        
                    <i class="fa fa-superpowers"></i> VIP:
                </div>
                <div class="col-xs-6" :class="{'bg-success': isVip}">
                    <label class="radio-inline">
                        <input type="radio" name="isVip" id=""                             
                            @change="updateVip"
                            value="1" :checked="employee.is_vip"
                        > Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="isVip" id="" 
                            @change="updateVip" 
                            value="0" :checked="! employee.is_vip"
                        > No
                    </label>
                </div>
            </div> <!-- ./Supervisor-->

            <div class="form-group col-md-6">
                <div class="col-xs-6 " :class="{'bg-success': isUniversal}">
                    <i class="fa fa-globe"></i> UNIVERSAL:
                </div>
                <div class="col-xs-6 " :class="{'bg-success': isUniversal}">
                    <label class="radio-inline">
                        <input type="radio" name="isUniversal" id="" value="1" 
                            @change="updateUniversal"
                            :checked="employee.is_universal" > Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="isUniversal" id="" value="0" 
                            @change="updateUniversal"
                            :checked="! employee.is_universal" > No
                    </label>
                </div>
            </div> <!-- ./Supervisor-->
        </div>
    </div>
</template>

<script>

export default {

    data () {
        return {
        };
    },

    computed: {
        employee() {
            return this.$store.getters['employee/getEmployee']
        },

        isVip() {
            return this.employee.is_vip
        },

        isUniversal() {
            return this.employee.is_universal
        }
    },

    methods: {
        updateVip(e) {
            axios.post(`/api/employees/${this.employee.id}/vip`, {'is_vip': e.target.value})
                .then(response => {
                    this.$store.dispatch('employee/set', response.data)
                })
        },
        updateUniversal(e) {
             axios.post(`/api/employees/${this.employee.id}/universal`, {'is_universal': e.target.value})
                .then(response => {
                    this.$store.dispatch('employee/set', response.data)
                })
        }
    }
};
</script>

<style lang="css" scoped>
</style>
