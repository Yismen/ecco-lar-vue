<template>
    <div class="EscalationsAdmin_Index">
        LastFiveDates
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12">
                    <last-five-dates :records="lastFiveDates"></last-five-dates>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <today-by-user :records="todayRecordsByUser"></today-by-user>
                </div>
                <div class="col-md-6">
                    <today-by-client :records="todayRecordsByClient"></today-by-client>
                </div>
            </div>
        </div>
        <!-- Weelly -->
        <div class="col-sm-12">
            <div class="col-sm-6">
                <this-week :records="this_week"></this-week>
            </div>
            <div class="col-sm-6">
                <last-week :records="last_week"></last-week>
            </div>
        </div>
        <!-- Month -->
        <div class="col-sm-12">
            <div class="col-sm-6">
                <this-month :records="this_month"></this-month>
            </div>
            <div class="col-sm-6">
                <last-month :records="last_month"></last-month>
            </div>
        </div>
        <!-- Month -->
        <div class="col-sm-12">
            <div class="col-sm-12">
                <last-ten-days :records="this_month"></last-ten-days>
            </div>
        </div>


    </div>
</template>

<script>
    import LastFiveDates from './partials/LastFiveDates'
    import TodayByClient from './partials/TodayByClient'
    import TodayByUser from './partials/TodayByUser'
    import ThisWeek from './partials/ThisWeek'
    import LastWeek from './partials/LastWeek'
    import ThisMonth from './partials/ThisMonth'
    import LastMonth from './partials/LastMonth'
    import LastTenDays from './partials/LastTenDays'

    export default {

        name: 'EscalationsAdmin_Index',

        data () {
            return {
                lastFiveDates: [],
                todayRecordsByClient: [],
                todayRecordsByUser: [],
                this_week: [],
                last_week: [],
                this_month: [],
                last_month: [],
                last_ten_days: [],
            };
        },

        components: {
            ThisWeek, LastWeek, ThisMonth, LastMonth, LastTenDays, LastFiveDates, TodayByClient, TodayByUser
        },

        mounted() {
            let vm = this;
            vm.getData();

            setInterval(function() {
                return vm.getData();
            }, 120000);
            
        },

        methods: {
            getData() {
                this.$http.post('/admin/escalations_admin/api')
                .then(response => {
                    if (response.data) {
                        let data = response.data;
                        this.lastFiveDates = data.lastFiveDates || [];
                        this.todayRecordsByClient = data.todayRecordsByClient || [];
                        this.todayRecordsByUser = data.todayRecordsByUser || [];
                        this.this_week = data.this_week || [];
                        this.last_week = data.last_week || [];
                        this.this_month = data.this_month || [];
                        this.last_month = data.last_month || [];
                    }
                });
            }
        },

        computed: {
        }
    };
</script>

<style lang="css" scoped>
</style>