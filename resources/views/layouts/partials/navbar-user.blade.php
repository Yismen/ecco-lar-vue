<!--
===============================================================
  * Variable $user is set at App\Providers\ViewsComposerServiceProvider.
===============================================================
-->
<style type="text/css">
  .navbar-user-photo img {
    height: 20px;
  }
</style>

@if (!$user)

<li><a href="{{ url('login') }}"><i class="fa fa-user"></i> Login</a></li>
<li><a href="{{ url('register') }}"><i class="fa fa-user"></i> Register</a></li>

@else
<!-- Messages: style can be found in dropdown.less-->
@include('layouts.partials.navbar-user-features')
<!-- User Account Menu -->
<li class="dropdown user user-menu">
  <!-- Menu Toggle Button -->
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <!-- The user image in the navbar-->
    <span class="navbar-user-photo">
      @include('layouts.partials.user-photo')
    </span>
    <!-- hidden-xs hides the username on small devices so only the image appears. -->
    <span class="hidden-xs">{{ $user->name }}</span>
  </a>
  <ul class="dropdown-menu">
    <!-- The user image in the menu -->
    <li class="user-header">
      @include('layouts.partials.user-photo')
      <p>
        {{ $user->name }}
        {{-- {{ $user->name }} - <h5>{!! $user->profile->work ?? null !!}</h5> --}}
        {{-- <small>Member since {{ $user->created_at->toFormattedDateString() }}</small> --}}
        <small>Member since {{ $user->created_at->diffForHumans() }}</small>
      </p>
    </li>
    <!-- Menu Body -->
    <li class="user-body">
      <div class="row">
        <div class="col-xs-4 text-center">
          <a href="/admin/contacts">
            <i class="fa fa-users"></i> Contacts
          </a>
        </div>
        {{-- <div class="col-xs-4 text-center">
          <a href="{{ route('admin.passwords.index') }}">
            <i class="fa fa-archive"></i> Vault
          </a>
        </div> --}}
        <div class="col-xs-4 text-center pull-right">
          <a href="/admin/users/reset"><i class="fa fa-key"></i> Change Password</a>
        </div>
      </div>
      <!-- /.row -->
    </li>
    <!-- Menu Footer-->
    <li class="user-footer bg-{{ $color }}">
      <div class="pull-left">
        <a href="{{ route('admin.profiles.index') }}">
          <i class="fa fa-user"></i> Profile
        </a>
      </div>
      <div class="pull-right">
        <a href="/" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
          <i class="fa fa-sign-out"></i> Log out
        </a>
        <form id="logout-form" action="/logout" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
      </div>
    </li>
  </ul>
</li>
<li>
  <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
</li>


<!-- Control Sidebar Toggle Button -->

@endif
