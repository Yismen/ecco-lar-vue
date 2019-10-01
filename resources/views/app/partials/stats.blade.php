<div class="row">
    <div class="col-xs-6 col-md-4 col-xl-3">
        @component('components.info-box', ['color' => 'bg-red', 'icon' => 'fa fa-users'])
            Users
            @slot('number')
                {{ $users_count }}
            @endslot
        @endcomponent
    </div>

    <div class="col-xs-6 col-md-4 col-xl-3">
        @component('components.info-box', ['color' => 'bg-red', 'icon' => 'fa fa-building'])
            Sites
            @slot('number')
                {{ $sites }}
            @endslot
        @endcomponent
    </div>

    <div class="col-xs-6 col-md-4 col-xl-3">
        @component('components.info-box', ['color' => 'bg-red', 'icon' => 'fa fa-book'])
            Projects
            @slot('number')
                {{ $projects }}
            @endslot
        @endcomponent
    </div>

    <div class="col-xs-6 col-md-4 col-xl-3">
        @component('components.info-box', ['color' => 'bg-red', 'icon' => 'fa fa-users'])
            Employees
            @slot('number')
                {{ $employees_count }}
            @endslot
        @endcomponent
    </div>
</div>
