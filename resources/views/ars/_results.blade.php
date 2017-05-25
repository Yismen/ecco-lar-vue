<div class="table-responsive">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>ARS</th>
                <th>Employees</th>
                <th class="col-xs-2">Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($arss as $ars)
                <tr>
                    <td>
                        <a href="/admin/ars/{{ $ars->slug }}">{{ $ars->name }}</a>
                    </td>

                    <td>
                        <strong>{{ count($ars->employees) }}</strong>
                    </td>

                    <td>
                        <a href="/admin/ars/{{ $ars->slug }}/edit" title="Edit ARS">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> {{-- /. Table --}}