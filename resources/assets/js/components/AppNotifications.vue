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
            <li v-for="notification in notificationsData" :key="notification.id" :class="parseClass(notification.type)"><!-- start notification -->
              <a href="#" @click.prevent="showModal(notification)" :title="notification.data.body || 'No body message!'">
                <i class="fa fa-bell-o text-aqua"></i>{{ notification.data.subject || 'No Subject' }} 
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

      <modal name="notifications-modal" @before-open="beforeOpen"
         height="auto" :scrollable="true"
      >
        <div class="box box-solid">
          <div class="box-header with-border">
            <h4>
              {{ notification.subject || 'No Subject' }} 
              <a href="#" @click.prevent="closeModal" class="btn btn-link pull-right">
                X
              </a>
            </h4>
          </div>
          <div class="box-body">
            <p v-if="notification.body">{{ notification.body}} </p>
            <pre v-else>{{ notification }} </pre>
          </div>
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

      parseClass(css_class) {
        return css_class ? `bg-${css_class}` : ''
      },
      showModal(notification) {
        this.$modal.show("notifications-modal", notification)
      },
      closeModal() {
        this.$modal.hide('notifications-modal')
      },
      beforeOpen(event) {
        // console.log(event)
        // send ajax to mark as read
        this.notification = event.params.data        
      },
      markAllAsRead() {
          axios.post('/api/notifications/mark-all-as-read').
              then(response => {
                this.notificationsData = response.data
              })
      }
    }
}
</script>

<style>

</style>