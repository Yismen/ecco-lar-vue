<div class="table-responsive">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Id</th>
                <th>AFP</th>
                <th class="col-xs-2">Employees</th>
                <th class="col-xs-2">Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($afps as $afp)
                <tr>
                    <td>{{ $afp->id }} </td>
                    <td>
                        <a href="/admin/afps/{{ $afp->slug }}">{{ $afp->name }}</a>
                    </td>

                    <td>
                        <strong>{{ count($afp->employees) }}</strong>
                    </td>

                    <td>
                        <a href="/admin/afps/{{ $afp->slug }}/edit" title="Edit AFP">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> {{-- /. Table --}}