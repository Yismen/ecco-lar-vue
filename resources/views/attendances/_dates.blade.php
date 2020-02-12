<div class="col-sm-8 col-sm-offset-2">
    <div class="box box-primary">
        <div class="box-header">
            <h4>
                Search by Date:
                <a href="{{ route('admin.attendances.index') }}" class="pull-right">
                    <i class="fa fa-home"></i> List
                </a>
            </h4>
        </div>

        <div class="box-body" style="max-height: 200px; overflow-y: auto;">
            @foreach ($dates as $item)
                <a href="{{ route('admin.attendances.date', $item->date) }}" 
                    class="btn btn-xs {{ $item->date == request()->route()->parameters('date')['date'] ? 'btn-primary' : 'btn-default' }}">
                    {{ $item->date }}
                </a>
            @endforeach
        </div>
    </div>
</div>