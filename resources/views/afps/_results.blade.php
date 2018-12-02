<div class="table-responsive">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>AFP</th>
                <th class="col-xs-2">Employees</th>
                <th class="col-xs-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($afps as $afp)
                <tr>
                    <td>
                        <a href="/admin/afps/{{ $afp->slug }}">{{ $afp->name }}</a>
                    </td>

                    <td>
                        <strong>
                                <span class="label {{ count($afp->employees) > 0 ? 'label-info' : 'label-default' }}">{{ count($afp->employees) }}</span>
                        </strong>
                    </td>

                    <td>
                        <a href="/admin/afps/{{ $afp->slug }}/edit" title="Edit AFP">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> {{-- /. Table --}}