<h4>Your Apps</h4>

<div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
    @if ($user && $user->roles->count() > 0)
        @foreach ($user->roles as $role)
            <div class="box box-primary" style="max-height: 200px; overflow-y: auto; width: 200px; ">
                <div class="box-header">
                    <h5 class="no-margin" style="text-transform: uppercase;">{{ personName($role->name) }}</h5>
                </div>

                @if ($role->menus && $role->menus->count() > 0)
                    <div class="box-body" style="padding-top: 0;">
                        <div class="list-group">
                            @foreach ($role->menus as $menu)
                                <a href="/{{ $menu->name }}" class="list-group-item" style="padding: 3px 10px;">
                                    {{ $menu->display_name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    @endif
</div>
