<div class="row">
    <div class="col-xs-6 col-lg-12">
        @include('human_resources.birthdays.list_today')
        <div class="row">
            <div class="col-lg-6">
                @include('human_resources.birthdays.count_this_month')
            </div>
            <div class="col-lg-6">
                @include('human_resources.birthdays.count_next_month')
            </div>
            <div class="col-lg-6">
                @include('human_resources.birthdays.count_last_month')
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-lg-12">
        @include('dashboards.human_resources._issues')
    </div>
</div>