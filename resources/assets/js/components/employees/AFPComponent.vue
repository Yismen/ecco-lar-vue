<template>
    <div class="_AFP well">
        <form class="form-horizontal" role="form"
            autocomplete="off"
            @submit.prevent="handleUpdateAfp"
            @change="updated"
        >

            <div class="box-header with-border">
                <h4>AFP Info:</h4>
            </div>

            <div class="box-body" :class="{'has-error': form.error.has('afp_id')}">
                <div class="form-group">
                    <label for="input" class="col-sm-2 control-label">AFP:</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <select name="afp_id" id="afp_id" class="form-control" v-model="form.fields.afp_id">
                                <option v-for="(afp, index) in afp_list" :value="afp.id" :key="afp.id">{{ afp.name }}</option>
                            </select>
                            <a href="#" @click.prevent="$modal.show('create-afp')" class="input-group-addon">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </div>
                        <span class="text-danger" v-if="form.error.has('afp_id')">{{ form.error.get('afp_id') }}</span>
                    </div>
                </div> <!-- ./AFP-->
            </div>

            <div class="box-footer">
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">
                            Save AFP
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <create-afp-form @afp-created="afpCreated"></create-afp-form>
        <!-- ./ Modal -->
    </div>
</template>

<script>
import CreateAfpForm from '../forms/CreateAfp'

export default {
name: 'AFPComponent',

data () {
    return {
        afp_list: [],
        form: new (this.$ioc.resolve('Form')) ({
            'afp_id': this.getAfpId(),
        }, false)
    };
},

computed: {
    employee() {
        return this.$store.getters['employee/getEmployee']
    }
},

components: {CreateAfpForm },

mounted() {
    return this.afp_list = this.employee.afp_list
},

methods: {
    getAfpId() {
        return this.$store.getters['employee/getEmployee'].afp_id
    },
    updated(event) {
        this.form.error.clear(event.target.name)
    },
    handleUpdateAfp() {
        this.form.put('/admin/employees/' + this.employee.id + '/afp')
            .then(response => {
                this.$store.dispatch('employee/set', response.data)
                return this.form.fields.afp_id = response.data.afp.id
            })
    },
    afpCreated(data) {
        return this.afp_list.unshift(data)
    }
}
};
</script>

<style lang="css" scoped>
</style>
