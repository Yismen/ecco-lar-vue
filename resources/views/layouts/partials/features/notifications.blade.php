<!-- Notifications Menu -->
  <li class="dropdown notifications-menu">
    <!-- Menu toggle button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <i class="fa fa-bell-o"></i>
      <span class="label {{ $user->unreadNotifications->count() > 0 ? 'label-info' : 'bg-gray' }}">
        {{ $user->unreadNotifications->count() }} 
      </span>
    </a>
    <ul class="dropdown-menu">
      <li class="header">You have {{  $user->unreadNotifications->count()  }} new notifications</li>
      <li>
        <!-- Inner Menu: contains the notifications -->
        <ul class="menu">
          @foreach ($user->unreadNotifications as $notification)
            <li><!-- start notification -->
              <a href="#" title="{{ \Illuminate\Support\Arr::get($notification->data, 'body') }} ">
                <i class="fa fa-bell-o text-aqua"></i> {{ \Illuminate\Support\Arr::get($notification->data, 'subject') }} 
              </a>
            </li>
            <!-- end notification -->
          @endforeach
        </ul>
      </li>
      @if ($user->unreadNotifications->count() > 0)
        <a href="{{ route('admin.mark-all-notifications-as-read') }}" 
          class="btn btn-danger form-control"
          title="All notifications will be marked as completed!">
          Mark All as Read
        </a>
        {{-- <li class="footer">
        </li> --}}
      @endif
    </ul>
  </li>