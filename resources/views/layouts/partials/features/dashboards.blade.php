@can('view-dashboards')

@endcan
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
            aria-expanded="false">
            <i class="fa fa-dashboard"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('admin.default_dashboard') }}">
                    <i class="fa fa-dashboard"></i> Default
                </a>
            </li>
            @can('view-owner-dashboard')
                <li>
                    <a href="{{ route('admin.owner_dashboard') }}">
                        <i class="fa fa-dashboard"></i> Owner
                    </a>
                </li>
            @endcan  
            @can('view-admin-dashboard')
                <li>
                    <a href="{{ route('admin.admin_dashboard') }}">
                        <i class="fa fa-dashboard"></i> Admin
                    </a>
                </li>
            @endcan       
            @can('view-human-resources-dashboard')
                <li>
                    <a href="{{ route('admin.human_resources_dashboard') }}">
                        <i class="fa fa-dashboard"></i> HHRR
                    </a>
                </li>
            @endcan    
        </ul>

    </li>