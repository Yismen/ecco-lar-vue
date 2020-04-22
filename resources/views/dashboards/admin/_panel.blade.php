<div class="box box-primary">
    <div class="box-body">
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>
                        <a href="{{ route('admin.roles.index') }}" target="_roles">
                            Roles <i class="fa fa-arrow-right"></i>
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('admin.users.index') }}" target="_users">
                            Users <i class="fa fa-arrow-right"></i>
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('admin.permissions.index') }}" target="_permissions">
                            Permissions <i class="fa fa-arrow-right"></i>
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('admin.menus.index') }}" target="_menus">
                            Menus <i class="fa fa-arrow-right"></i>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
               @foreach ($roles as $role)
                    <tr>
                        <td>
                            <div class="text-center">
                                <h5>{{ $role->name_parsed }}</h5>
                                <i class="fa fa-users fa-2x"></i>
                            </div>
                        </td>
                        <td>
                            <ul style="max-height: 200px; overflow-y: auto;">
                                @foreach ($role->users as $user)
                                    <li>
                                        <a href="{{ route('admin.profiles.show', $user->id) }}" target="_users">
                                            {{ $user->name }} 
                                        </a>
                                        <i 
                                            class="fa fa-circle {{ $user->isOnline() ? 'text-green' : 'text-gray'}}"
                                            title="{{ $user->isOnline() ? 'Online' : 'Away'}}"
                                        ></i>
                                        @unless ($loop->last)
                                            <br>
                                        @endunless    
                                    </li>   
                                @endforeach
                            </ul>
                        </td>
                        
                        <td>
                            <ul style="max-height: 200px; overflow-y: auto;">
                                @foreach ($role->permissions as $permission)
                                    <li>
                                        {{ $permission->name }} 
                                        @unless ($loop->last)
                                            <br>
                                        @endunless    
                                    </li>   
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul style="max-height: 200px; overflow-y: auto;">
                                @foreach ($role->menus as $menu)
                                    <li>
                                        {{ $menu->name }} 
                                        @unless ($loop->last)
                                            <br>
                                        @endunless    
                                    </li>   
                                @endforeach
                            </ul>
                        </td>
                    </tr>
               @endforeach                
            </tbody>
        </table>
    </div>
</div>