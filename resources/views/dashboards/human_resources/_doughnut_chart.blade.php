<div class="col-xs-4">
    <div class="box box-primary">
        <div class="box-header">
            <h4>{{ $title }}</h4>
        </div>
        <div class="box-body no-padding">
            <doughnut-base-chart
                :labels="{{ $headcounts[$data_key]['labels'] }}"
                :dataset="{{ $headcounts[$data_key]['data'] }}"
            ></doughnut-base-chart>
        </div>

        <div class="box-footer">
            <a href="{{ $link_route }}" title="{{ $title }} Details">
                Details
                <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>