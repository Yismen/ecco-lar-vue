<div class="table-responsive">
    <table class="table table-condensed table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>ARS</th>
                <th class="col-xs-2">Employees</th>
                <th class="col-xs-2">Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($arss as $ars)
                <tr>
                    <td>{{ $ars->id }} </td>
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