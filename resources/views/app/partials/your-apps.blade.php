<h4>Your Apps</h4>

@if ($user && $user->roles->count() > 0)
    <div class="row">
        @foreach ($user->roles as $role)
            <div class="col-xs-6 col-md-12" style="">
                <div class="box box-primary" style="max-height: 200px; overflow-y: auto; ">
                    <div class="box-header">
                        <h5 class="no-margin" style="text-transform: uppercase;">{{ personName($role->name) }}</h5>
                    </div>

                    @if ($role->menus && $role->menus->count() > 0)
                        <div class="box-body no-padding" style="padding-top: 0;">
                            <div class="list-group no-margin">
                                @foreach ($role->menus as $menu)
                                    <a href="/{{ $menu->name }}" class="list-group-item" style="padding: 3px 10px;">
                                        {{ $menu->display_name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif
