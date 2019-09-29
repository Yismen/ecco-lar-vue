<!--
    ===============================================================
    * Variable $user is set at App\Providers\ViewsComposerServiceProvider.
    ===============================================================
-->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">

        <!-- Sidebar user panel (optional) -->
        @if($user)

            <div class="user-panel" style="display: flex; align-items: center; flex-direction: row;">
                <div class="image">
                    @include('layouts.partials.user-photo', ['user'=>$user, 'class_image_class'=>'user-image'])
                </div>
                <div class="info">
                    <p>
                        <a href="/profiles">
                            {{ $user->profile->name ?? $user->name }}
                        </a>
                    </p>
                    <!-- Status -->
                    <!-- <a href="#"><i class="fa fa-circle text-success"></i> Status</a> -->
                </div>
            </div>

        @endif

        <!-- search form (Optional) -->
        {{-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form> --}}
        <!-- /.search form -->




        <!-- Sidebar Menu -->
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-link"></i>
                    <span>QUICK LINKS!</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    {{-- <li>
                        <a href="{{ route('notes.index') }}"><i class="fa fa-circle-o text-red"></i> Notes List</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.notes.index') }}"><i class="fa fa-circle-o text-red"></i> Admin Notes</a>
                    </li> --}}
                    <li>
                        <a href="{{ route('date_calc.index') }}"><i class="fa fa-circle-o text-red"></i> Date Diff
                            Calculator</a>
                    </li>
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


            <li class="header">APP LINKS</li>
            @if ($user && $user->roles)
                @foreach ($user->roles as $role)
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-link"></i>
                            <span>{{ personName($role->name) }}</span>
                            <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                @foreach ($role->menus as $menu)
                                    <li>
                                        <a href="{{ url($menu->name) }}">
                                            <i class="{{ filled($menu->icon) ? $menu->icon : 'fa fa-circle-o' }} text-red">
                                            </i> {{ $menu->display_name }}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </a>
                    </li>

                @endforeach
            @endif

        </ul>
        <!-- /.sidebar-menu -->

    </section>
        <!-- /.sidebar -->
</aside>
