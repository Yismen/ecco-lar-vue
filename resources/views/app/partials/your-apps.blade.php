<h4>Your Apps</h4>

<div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
    @if ($user && $user->roles->count() > 0)
        @foreach ($user->roles as $role)
            <div class="box box-primary" style="max-height: 200px; overflow-y: auto; width: 200px;">
                <div class="box-header">
                    <h4>{{ personName($role->name) }}</h4>
                </div>

                <div class="box-body">
                    @if ($role->menus && $role->menus->count() > 0)
                        <div class="list-group">
                            @foreach ($role->menus as $menu)
                                <a href="/{{ $menu->name }}" class="list-group-item" style="padding: 3px 10px;">
                                    {{ $menu->display_name }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
