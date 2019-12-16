@foreach ($user->roles as $role)                                            
    <span class="badge bg-green">{{ $role->name }}</span>  
@endforeach