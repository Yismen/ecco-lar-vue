<template>
    <div>
        <div class="row">
            <div class="col-sm-12 ">
                <div class="btn-group floated">
                    <label class="btn btn-primary" :class="{'active focus': queue == '%'}">
                        <input type="radio" name="options" id="option1" checked v-model="queue" value="%" @change="getData"> All
                    </label>
                    <label class="btn btn-primary" :class="{'active focus': queue == 'chat'}">
                        <input type="radio" name="options" id="option2" v-model="queue" value="chat" @change="getData"> Chats
                    </label>
                    <label class="btn btn-primary" :class="{'active focus': queue == 'email'}">
                        <input type="radio" name="options" id="option3" v-model="queue" value="email" @change="getData"> Emails
                    </label>
                </div>

            </div>

            <br>

            <!-- Records -->
            <div class="col-lg-4 col-sm-6">
                <records-weekly :weeks="production.weekly"></records-weekly>
            </div>
            <div class="col-lg-4 col-sm-6">
                
                <div class="box box-success">
                    <div class="box-header">
                        Top Production Performers
                    </div>
                    <div class="box-body no-padding">
                        <table class="table table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>This week</th>
                                    <th>Last week</th>
                                    <th>Two weeks ago</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="index in 8" :key="index">
                                    <td>5000{{index}}</td>
                                    <td>Any name</td>
                                    <td>Any name</td>
                                    <td>Any name</td>
                                    <td>Any name</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-4 col-sm-6">
                <strong>Bottom ten QA Scores</strong>
            </div>

            <!-- TP and AHT -->
            <div class="col-lg-4 col-sm-6">
                <t-p-and-a-h-t-weekly :weeks="production.weekly"></t-p-and-a-h-t-weekly>
            </div>     
            <div class="col-lg-4 col-sm-6">
                <strong>Top and Bottom performers</strong>
            </div>   
            <div class="col-lg-4 col-sm-6">
                <strong>Top and Bottom performers</strong>
            </div>

            <!-- Ussage -->
            <div class="col-lg-4 col-sm-6">
                <ussage-weekly :weeks="production.weekly"></ussage-weekly>
            </div>
            <div class="col-lg-4 col-sm-6">
                <strong>Top and Bottom performers</strong>
            </div>
            <div class="col-lg-4 col-sm-6">
                <strong>Top and Bottom performers</strong>
            </div>

            <!-- QA Scores -->
            <div class="col-lg-4 col-sm-6">
                <qa-weekly :weeks="quality.weekly"></qa-weekly>
            </div>            
            <div class="col-lg-4 col-sm-6">
                <strong>Top and Bottom performers</strong>
            </div>
            <div class="col-lg-4 col-sm-6">
                <strong>Top and Bottom performers</strong>
            </div>
            <!-- QA Errors -->
            <!-- <div class="col-sm-6">
                <errors-daily :errors="errors.daily"></errors-daily>
            </div> -->
            <div class="col-sm-6">
                <errors-weekly :errors="errors.weekly"></errors-weekly>
            </div>            
            <div class="col-lg-4 col-sm-6">
                <strong>Top and Bottom performers</strong>
            </div>
            <div class="col-lg-4 col-sm-6">
                <strong>Top and Bottom performers</strong>
            </div>
        </div>
    </div>    
</template>

<script>
    import QaWeekly from './QA/Weekly'
    import ErrorsWeekly from './Errors/Weekly'
    import RecordsWeekly from './Productions/Records/Weekly'
    import TPAndAHTWeekly from './Productions/TPAndAHT/Weekly'
    import UssageWeekly from './Productions/Ussage/Weekly'

    export default {
        name: "BlackHawkCsManagement_Index",
        data() {
            return {
                quality: [],
                production: [],
                errors: [],
                queue: '%'
            }
        },
        components: {
            RecordsWeekly, 
            TPAndAHTWeekly, 
            UssageWeekly,
            QaWeekly,  
            ErrorsWeekly
        },
        created() {
            this.getData()
        },
        methods: {
            getData() {
                this.$http.get('/admin/blackhawk_cs/api/dashboard/supervisor?queue='+this.queue)
                    .then(response => {
                        this.production = response.data.production;
                        this.quality = response.data.quality;
                        this.errors = response.data.errors;
                    })
            }
        }
    }
</script>

<style lang="css" scoped>
    .floated {
        position: fixed;
        z-index: 99;
        display: block;
        bottom: 130px;
        right: 25px;
    }
</style>