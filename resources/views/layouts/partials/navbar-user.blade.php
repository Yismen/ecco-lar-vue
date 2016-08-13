<!-- 
===============================================================
  * Variable $user is set at App\Providers\ViewsComposerServiceProvider.
===============================================================
-->
<style type="text/css">
    .navbar-user-photo img{
        height:20px;
    }
</style>

@if (!$user)
  
  <li><a href="{{ url('/admin/login') }}"><i class="fa fa-user"></i>  Login</a></li>
  <li><a href="{{ url('/admin/register') }}"><i class="fa fa-user"></i> Register</a></li>

@else
  <!-- Messages: style can be found in dropdown.less-->
  {{-- @include('layouts.partials.navbar-user-features') comment --}}
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
          {{-- {{ $user->name }} - <h5>{!! $user->profile->work or null !!}</h5> --}}
          <small>Member since {{ $user->created_at->toFormattedDateString() }}</small>
        </p>
      </li>
      <!-- Menu Body -->
      <li class="user-body">
        <div class="row">
          <div class="col-xs-4 text-center">
            <a href="#">Followers</a>
          </div>
          <div class="col-xs-4 text-center">
            <a href="#">Sales</a>
          </div>
          <div class="col-xs-4 text-center">
            <a href="#">Friends</a>
          </div>
        </div>
        <!-- /.row -->
      </li>
      <!-- Menu Footer-->
      <li class="user-footer">
        <div class="pull-left">
          <a href="{{ route('admin.profiles.index') }}" class="btn btn-default btn-flat">Profile</a>
        </div>
        <div class="pull-right">
          <a href="{{ url('admin/logout') }}" class="btn btn-default btn-flat">Sign out</a>
        </div>
      </li>
    </ul>
  </li>
  <!-- Control Sidebar Toggle Button -->
  <li>
    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
  </li>

@endif
