<template>
    <div>
        <div class="row">
            <div class="col-sm-12 ">
                <div class="btn-group floated">
                    <label class="btn btn-success" :class="{'active focus': queue == '%'}">
                        <input type="radio" name="options" id="option1" checked v-model="queue" value="%" @change="getData"> All
                    </label>
                    <label class="btn btn-success" :class="{'active focus': queue == 'chat'}">
                        <input type="radio" name="options" id="option2" v-model="queue" value="chat" @change="getData"> Chats
                    </label>
                    <label class="btn btn-success" :class="{'active focus': queue == 'email'}">
                        <input type="radio" name="options" id="option3" v-model="queue" value="email" @change="getData"> Emails
                    </label>
                </div>

            </div>

            <br>

            <!-- Records -->
            <div class="col-lg-4 col-sm-6">
                <records-daily :days="production.daily"></records-daily>
            </div>
            <div class="col-lg-4 col-sm-6">
                <records-weekly :weeks="production.weekly"></records-weekly>
            </div>
            <div class="col-lg-4 col-sm-6">
                <records-monthly :months="production.monthly"></records-monthly>
            </div>

            <!-- TP and AHT -->
            <div class="col-lg-4 col-sm-6">
                <t-p-and-a-h-t-daily :days="production.daily"></t-p-and-a-h-t-daily>
            </div>   
            <div class="col-lg-4 col-sm-6">
                <t-p-and-a-h-t-weekly :weeks="production.weekly"></t-p-and-a-h-t-weekly>
            </div>     
            <div class="col-lg-4 col-sm-6">
                <t-p-and-a-h-t-monthly :months="production.monthly"></t-p-and-a-h-t-monthly>
            </div>

            <!-- Ussage -->
            <div class="col-lg-4 col-sm-6">
                <ussage-daily :days="production.daily"></ussage-daily>
            </div><div class="col-lg-4 col-sm-6">
                <ussage-weekly :weeks="production.weekly"></ussage-weekly>
            </div>
            <div class="col-lg-4 col-sm-6">
                <ussage-monthly :months="production.monthly"></ussage-monthly>
            </div>

            <!-- QA Scores -->
            <div class="col-lg-4 col-sm-6">
                <qa-daily :days="quality.daily"></qa-daily>
            </div>
            <div class="col-lg-4 col-sm-6">
                <qa-weekly :weeks="quality.weekly"></qa-weekly>
            </div>
            <div class="col-lg-4 col-sm-6">
                <qa-monthly :months="quality.monthly"></qa-monthly>
            </div>
            <!-- QA Errors -->
            <!-- <div class="col-sm-6">
                <errors-daily :errors="errors.daily"></errors-daily>
            </div> -->
            <div class="col-sm-6">
                <errors-weekly :errors="errors.weekly"></errors-weekly>
            </div>
            <div class="col-sm-6">
                <errors-monthly :errors="errors.monthly"></errors-monthly>
            </div>
        </div>
    </div>    
</template>

<script>
    import QaMonthly from './QA/Monthly'
    import QaWeekly from './QA/Weekly'
    import QaDaily from './QA/Daily'
    import ErrorsWeekly from './Errors/Weekly'
    import ErrorsMonthly from './Errors/Monthly'
    import RecordsMonthly from './Productions/Records/Monthly'
    import RecordsWeekly from './Productions/Records/Weekly'
    import RecordsDaily from './Productions/Records/Daily'
    import TPAndAHTWeekly from './Productions/TPAndAHT/Weekly'
    import TPAndAHTMonthly from './Productions/TPAndAHT/Monthly'
    import TPAndAHTDaily from './Productions/TPAndAHT/Daily'
    import UssageWeekly from './Productions/Ussage/Weekly'
    import UssageMonthly from './Productions/Ussage/Monthly'
    import UssageDaily from './Productions/Ussage/Daily'

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
            RecordsMonthly, RecordsWeekly, RecordsDaily, 
            TPAndAHTWeekly, TPAndAHTMonthly, TPAndAHTDaily, 
            UssageWeekly, UssageMonthly, UssageDaily,
            QaMonthly, QaWeekly, QaDaily, 
            ErrorsMonthly, ErrorsWeekly
        },
        created() {
            this.getData()
        },
        methods: {
            getData() {
                this.$http.get('/admin/blackhawk_cs/api/dashboard/management?queue='+this.queue)
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