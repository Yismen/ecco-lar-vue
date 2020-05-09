@inject('layout', 'App\Layout')
@extends('layouts.'.$layout->app(), ['page_header'=>'Users', 'page_description'=>'Handle
the users configurations and setting.']) @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="row">
                <div class="col-md-3">
                    @if (isset($users))
                        <div class="box box-success">
                            <div class="box-header">
                                <h4>Online Users</h4>
                            </div>

                            <ul class="list-group">
                                @foreach ($users as $user)
                                    @if ($user->isOnline())
                                        <li class="list-group-item">
                                            <a href="{{ route('admin.profiles.show', $user->id) }}">
                                                <i class="fa fa-user"></i> {{ $user->name }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <div class="box box-primary">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua">
                                    <i class="fa fa-users"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Active Users</span>
                                    <span class="info-box-number">{{ $users->count() }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-9">
                    <h3>
                        Users List
                        <a href="{{ route('admin.users.create') }}" class="pull-right">
                            <i class="fa fa-plus"></i>
                            Add New
                        </a>
                    </h3>
                    <div class="row">
                        <div class="form-group">
                            Search: <input type="text" id="js-search">
                        </div>
                    </div>
                    <div class="row">
                        <div id="js-results">
                            @include('partials._users')
                        </div>
                    </div>

                </div>
            </div>
            {{-- /.row --}}
            <div class="row">
                <div class="col-sm-12">
                    <h3>OAuth API Users</h3>

                    <div class="box box-warning">
                        <div class="box-body">
                            <passport-clients></passport-clients>
                        </div>
                    </div>
                    {{-- /.box --}}

                    <div class="box box-warning">
                        <div class="box-body">
                            <passport-personal-access-tokens></passport-personal-access-tokens>
                        </div>
                    </div>
                    {{-- /.box --}}

                    <div class="box box-warning">
                        <div class="box-body">
                            <passport-authorized-clients></passport-authorized-clients>
                        </div>
                    </div>
                    {{-- /.box --}}
                </div>
            </div>
            {{-- /.row --}}
        </div>
    </div>
</div>
@stop
@push('scripts')
    <script defer>
        (function() {
            document.getElementById('js-search')
                .addEventListener('input', _.debounce(function(e) {
                    fetch(`/admin/users/search?q=${e.target.value}`)
                        .then(response => response.text())
                        .then(html => document.getElementById('js-results').innerHTML = html)
                }, 700))
        })()
    </script>
@endpush
