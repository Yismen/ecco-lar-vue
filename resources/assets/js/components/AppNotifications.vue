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
        <a href="#" @click.prevent="fetchUnreadNotifications" class="pull-right" title="Refresh Notifications">
          <i class="fa fa-refresh"></i>
        </a>
      </li>
      <li>
        <!-- Inner Menu: contains the notifications -->
        <ul class="menu">
            <li v-for="notification in notificationsData" :key="notification.id"><!-- start notification -->
              <a href="#" :title="notification.data.body || 'No body message!'">
                <i class="fa fa-bell-o text-aqua"></i>{{ notification.data.subject || 'No subject' }} 
              </a>
            </li>
            <!-- end notification -->
        </ul>
      </li>
      
        <a href="#" v-if="count > 0"
            @click.prevent="markAllAsRead"
          class="btn btn-danger form-control"
          title="All notifications will be marked as completed!">
          Mark All as Read
        </a>
        <!-- <li class="footer">
        </li> -->
      </ul>
  </li>
</template>

<script>
export default {
    data() {
        return {
            notificationsData: this.notifications
        }
    },

    props: ['notifications'],

    computed: {
        count() {
            return this.notificationsData.length
        }
    }, 
    
    methods: {
        fetchUnreadNotifications() {
            axios.get('/api/notifications/unread')
                .then(response => this.notificationsData = response.data)
        },

        markAllAsRead() {
            axios.post('/api/notifications/mark-all-as-read').
                then(response => {
                  console.log(response.data)
                  this.notificationsData = response.data
                })
        }
      
    }
}
</script>

<style>

</style>