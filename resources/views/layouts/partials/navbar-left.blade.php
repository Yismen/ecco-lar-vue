<!-- 
===============================================================
  * Variable $user is set at App\Providers\ViewsComposerServiceProvider.
===============================================================
-->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">              

    <!-- Sidebar user panel (optional) -->
    @if($user)
      <div class="user-panel">
        <div class="pull-left image">
          @include('layouts.partials.user-photo', ['user'=>$user])
        </div>
        <div class="pull-left info">
          <p>
            {{ $user->profile->name or $user->name }}
          </p>
          <!-- Status -->
          <!-- <a href="#"><i class="fa fa-circle text-success"></i> Status</a> -->
        </div>
      </div>
    @endif
    <!-- search form (Optional) -->
    <!-- <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form> -->
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">QUICK LINKS</li>
      <!-- Optionally, you can add icons to the links -->
      <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Notes</span> 
        <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href=" route('notes.index') }}">Notes List</a></li>
          <li><a href="{{ route('notes.index') }}">Admin Notes</a></li>
        </ul>
      </li>

      <!-- <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span> 
        <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="#">Link in level 2</a></li>
          <li><a href="#">Link in level 2</a></li>
        </ul>
      </li> -->


      <li class="header">APP</li>
      @if ($user)
        @foreach ($user->rolesList as $role)
          <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>{{ $role->display_name }}</span> 
            <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              @foreach ($role->menus as $menu)
                <li>
                  <a href="{{ url('admin/'.$menu->name) }}">
                    {{ $menu->display_name }}
                  </a>
                </li>
              @endforeach
            </ul>
          </li>
        @endforeach
      
      @else
        <li><h4>You are not logged in!</h4></li>
      @endif

    </ul>
    <!-- /.sidebar-menu -->
    
  </section>
    <!-- /.sidebar -->

</aside>


