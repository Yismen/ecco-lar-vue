<h4>Your Apps</h4>
    @if ($user && $user->roles->count() > 0)
        @foreach ($user->roles as $role)
            <div class="box box-primary" style="max-height: 200px; overflow-y: auto;">
                <div class="box-header">
                    <h4>{{ personName($role->name) }}</h4>
                </div>

                <div class="box-body">
                    @if ($role->menus && $role->menus->count() > 0)
                        <div class="list-group">
                            @foreach ($role->menus as $menu)
                                <a href="/{{ $menu->name }}" class="list-group-item">{{ $menu->display_name }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
