<div class="table-responsive">
    <table class="table table-condensed table-bordered">
        <thead>
            <tr>
                <th>ARS</th>
                <th class="col-xs-2">Employees</th>
                <th class="col-xs-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($arss as $ars)
                <tr>
                    <td>
                        <a href="{{ route('admin.arss.show', $ars->slug) }}">{{ $ars->name }}</a>
                    </td>

                    <td>
                        <span class="label {{ count($ars->employees) ? 'label-info' : 'label-default' }}">
                            {{ count($ars->employees) }}
                        </span>
                    </td>

                    <td>
                        <a href="{{ route('admin.arss.edit', $ars->slug) }}" title="Edit ARS">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> {{-- /. Table --}}