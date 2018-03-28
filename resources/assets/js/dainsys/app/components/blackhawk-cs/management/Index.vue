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

            <div class="col-lg-4 col-sm-6">
                <records-weekly :weeks="production.weekly"></records-weekly>
            </div>

            <div class="col-lg-4 col-sm-6">
                <records-monthly :months="production.monthly"></records-monthly>
            </div>

            <div class="col-lg-4 col-sm-6">
                <records-yearly :years="production.yearly"></records-yearly>
            </div>            

            <div class="col-lg-4 col-sm-6">
                <t-p-and-a-h-t-weekly :weeks="production.weekly"></t-p-and-a-h-t-weekly>
            </div>      

            <div class="col-lg-4 col-sm-6">
                <t-p-and-a-h-t-monthly :months="production.monthly"></t-p-and-a-h-t-monthly>
            </div>

            <div class="col-lg-4 col-sm-6">
                <t-p-and-a-h-t-yearly :years="production.yearly"></t-p-and-a-h-t-yearly>
            </div>

            <div class="col-lg-4 col-sm-6">
                <utilization-and-efficiency-weekly :weeks="production.weekly"></utilization-and-efficiency-weekly>
            </div>

            <div class="col-lg-4 col-sm-6">
                <utilization-and-efficiency-monthly :months="production.monthly"></utilization-and-efficiency-monthly>
            </div>

            <div class="col-lg-4 col-sm-6">
                <utilization-and-efficiency-yearly :years="production.yearly"></utilization-and-efficiency-yearly>
            </div>

            <div class="col-lg-4 col-sm-6">
                <qa-weekly :weeks="quality.weekly"></qa-weekly>
            </div>
            <div class="col-lg-4 col-sm-6">
                <qa-monthly :months="quality.monthly"></qa-monthly>
            </div>
            <div class="col-lg-4 col-sm-6">
                <qa-yearly :years="quality.yearly"></qa-yearly>
            </div>
            <div class="col-lg-4 col-sm-6">
                <errors-this-month :this_month="errors.this_month"></errors-this-month>
            </div>
            <div class="col-lg-4 col-sm-6">
                <errors-last-month :last_month="errors.last_month"></errors-last-month>
            </div>
            <div class="col-lg-4 col-sm-6">
                <errors-two-months-ago :two_months_ago="errors.two_months_ago"></errors-two-months-ago>
            </div>
            
            Transactions (monthly, weekly, yearly) 
            AHT  (line, monthly, weekly, yearly)
            
            Thruput (line, monthly, weekly, yearly)
            
            Utilization and Efficiency (line, monthly, weekly, yearly)
        </div>
    </div>    
</template>

<script>
    import QaMonthly from './QA/Monthly'
    import QaWeekly from './QA/Weekly'
    import QaYearly from './QA/Yearly'
    import ErrorsThisMonth from './Errors/ThisMonth'
    import ErrorsLastMonth from './Errors/LastMonth'
    import ErrorsTwoMonthsAgo from './Errors/TwoMonthsAgo'
    import RecordsMonthly from './Productions/Records/Monthly'
    import RecordsWeekly from './Productions/Records/Weekly'
    import RecordsYearly from './Productions/Records/Yearly'
    import TPAndAHTWeekly from './Productions/TPAndAHT/Weekly'
    import TPAndAHTMonthly from './Productions/TPAndAHT/Monthly'
    import TPAndAHTYearly from './Productions/TPAndAHT/Yearly'
    import UtilizationAndEfficiencyWeekly from './Productions/UtilizationAndEfficiency/Weekly'
    import UtilizationAndEfficiencyMonthly from './Productions/UtilizationAndEfficiency/Monthly'
    import UtilizationAndEfficiencyYearly from './Productions/UtilizationAndEfficiency/Yearly'

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
            RecordsMonthly, RecordsWeekly, RecordsYearly, 
            TPAndAHTWeekly, TPAndAHTMonthly, TPAndAHTYearly, 
            UtilizationAndEfficiencyWeekly, UtilizationAndEfficiencyMonthly, UtilizationAndEfficiencyYearly,
            QaMonthly, QaWeekly, QaYearly, 
            ErrorsThisMonth, ErrorsLastMonth, ErrorsTwoMonthsAgo
        },
        created() {
            this.getData()
        },
        methods: {
            getData() {
                this.$http.get('/admin/blackhawk-cs/api/management/dashboard?queue='+this.queue)
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