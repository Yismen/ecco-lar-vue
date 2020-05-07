@if (isset($users))
    <div class="col-xs-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Latest Members</h3>
                
                <div class="box-tools pull-right">
                    <span class="label label-danger">{{ $users->count() }} Users</span>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="max-height: 300px; overflow-y: auto;">
                @foreach ($users as $user)
                    <div class="col-xs-4 col-md-12 col-lg-6">
                        @if (file_exists(optional($user->profile)->photo))
                            <a href="{{ asset($user->profile->photo) }}" target="_user_photo">
                                <img src="{{ asset($user->profile->photo) }}"
                                    class="profile-user-img img-responsive img-circle img-thumbnail" alt="Image"
                                >
                            </a>
                        @else
                            <img src="http://placehold.it/300x300"
                                class="profile-user-img img-responsive img-circle img-thumbnail" alt="Image"
                            >
                        @endif
                        <a class="users-list-name" href="{{ route('admin.users.show', $user->id) }}" target="_user">
                            <i 
                                class="fa fa-circle {{ $user->isOnline() ? 'text-green' : 'text-gray'}}"
                            ></i> 
                            {{ $user->name }} 
                        </a>
                        <span class="users-list-date">{{ $user->created_at->diffForHumans() }}</span>
                    </div>
                @endforeach
                <!-- /.users-list -->
            </div>
        </div>
        <!-- /.info-box -->
    </div>
@endif