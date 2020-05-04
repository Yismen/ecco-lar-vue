<template>
<!-- Notifications Menu -->
<li class="dropdown notifications-menu">
    <!-- Menu toggle button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <span class="label" :class="[count > 0 ? 'label-info' : 'bg-gray']">
            {{ count }} 
        </span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">
            You have {{  count  }} new notifications
            <!-- <a href="#" @click.prevent="fetchUnreadNotifications" class="pull-right" title="Refresh Notifications">
            <i class="fa fa-refresh"></i>
            </a> -->
        </li>
        <li>
            <!-- Inner Menu: contains the notifications -->
            <ul class="menu">
                <li v-for="notification in notificationsData" 
                    :key="notification.id" 
                    :class="parseClass(notification.data.css_class)"
                ><!-- start notification -->
                    <a href="#" @click.prevent="showModal(notification)">
                        <i class="fa fa-bell-o text-aqua"></i>{{ notification.data.subject || 'No Subject' }} 
                    </a>
                </li>
                <!-- end notification -->
            </ul>
        </li>

        <a href="#" v-if="count > 0"
            @click.prevent="markAllAsRead"
            class="btn btn-danger form-control"
            title="All notifications will be marked as read!"
        >
            Mark All as Read
        </a>
        <!-- <li class="footer">
        </li> -->
    </ul>

    <modal name="notifications-modal" @before-open="beforeOpen"
        height="auto" :scrollable="true"
    >
        <div class="box box-solid">
            <div class="box-header with-border">
                <h4>
                    {{ notification.subject || 'No Subject' }} 
                    <a href="#" @click.prevent="closeModal" class="btn btn-link pull-right"> X </a>
                </h4>
            </div> 
            <!-- /.box-header -->
            <div class="box-body">
                <p v-if="notification.body">{{ notification.body}} </p>
                <pre v-else>{{ notification }} </pre>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                Notification type: {{ notification.type }}
            </div>
            <!-- /.box-footer -->
        </div>
    </modal>
</li>
</template>

<script>
export default {
    data() {
        return {
            notificationsData: this.notifications,
            notification: {}
        }
    },

    props: ['notifications', 'user_id'],

    mounted() {
        let vm = this
        window.Echo.private(`App.User.${this.user_id}`)
            .listen('UserAppNotificationSent', function(response) {
            vm.notificationsData.unshift(response.notification)
        })
    },

    computed: {
        count() {
            return this.notificationsData.length
        }
    }, 
    
    methods: {
        parseClass(css_class) {
            return String(css_class).search('bg-') >= 0 ? css_class : `bg-${css_class}`
        },
        showModal(notification) {
            this.$modal.show("notifications-modal", notification)
            },
        closeModal() {
            this.$modal.hide('notifications-modal')
        },
        beforeOpen(event) {
            let params = event.params
            this.notification = params.data
            this.notification.type = params.type

            axios.get(`/api/notifications/show/${params.id}`)
            .then(response => {
                this.notificationsData = this.notificationsData.filter(function(el) {              
                    return el.id != params.id              
                })            
            })
        },
        markAllAsRead() {
            this.$swal({
                type: 'warning',
                title: 'Confirm',
                text: "Are you sure you want to mark them all as read? By proceeding all notifications will disapear!",
                confirmButtonText: '<i class="fa fa-edit"></i> Confirm',
                confirmButtonClass: 'btn btn-warning',
            }).then((result) => {
                if (result.value) {
                    axios.post('/api/notifications/mark-all-as-read')
                    .then(response => {
                        this.notificationsData = response.data
                    })
                }
            })
        },
        fetchUnreadNotifications() {
            axios.get('/api/notifications/unread')
            .then(response => this.notificationsData = response.data)
        },
    }
}
</script>

<style lang="sass" scoped>

</style>