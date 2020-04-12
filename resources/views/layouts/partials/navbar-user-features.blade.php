
  {{-- @include('layouts.partials.features.messages') --}}
  {{-- @include('layouts.partials.features.tasks') --}}
  {{-- @include('layouts.partials.features.notifications') --}}
  @include('layouts.partials.features.dashboards')
  <app-notifications :notifications="{{ $user->unreadNotifications }} "></app-notifications>


