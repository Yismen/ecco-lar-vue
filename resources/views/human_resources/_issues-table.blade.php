<div class="box box-danger">
    <div class="box-header with-border"><h4><i class="fa fa-exclamation-triangle"> </i> Issues</h4></div>

    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-condensed table-bordered">
                <thead>
                    <tr>
                        <th>HH RR Situations</th>
                        <th class="col-xs-2">Count</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="{{ $stats['issues']['missing_address'] > 0 ? 'danger' : '' }}">
                        <th><a href="/admin/human_resources/issues/missing_address" target="_employees_">Missing Address</a></th>
                        <td>{{ $stats['issues']['missing_address'] }}</td>
                    </tr>
                    <tr class="{{ $stats['issues']['missing_punch'] > 0 ? 'danger' : '' }}">
                        <th><a href="/admin/human_resources/issues/missing_punch" target="_employees_">Missing Punch ID</a></th>
                        <td>{{ $stats['issues']['missing_punch'] }}</td>
                    </tr>
                    <tr class="{{ $stats['issues']['missing_ars'] > 0 ? 'danger' : '' }}">
                        <th><a href="/admin/human_resources/issues/missing_ars" target="_employees_">Missing ARS</a></th>
                        <td>{{ $stats['issues']['missing_ars'] }}</td>
                    </tr>
                    <tr class="{{ $stats['issues']['missing_ars'] > 0 ? 'danger' : '' }}">
                        <th><a href="/admin/human_resources/issues/missing_afp" target="_employees_">Missing AFP</a></th>
                        <td>{{ $stats['issues']['missing_afp'] }}</td>
                    </tr>
                    <tr class="{{ $stats['issues']['missing_bank_account'] > 0 ? 'danger' : '' }}">
                        <th><a href="/admin/human_resources/issues/missing_bank_account" target="_employees_">Missing Bank Acc.</a></th>
                        <td>{{ $stats['issues']['missing_bank_account'] }}</td>
                    </tr>
                    <tr class="{{ $stats['issues']['missing_supervisor'] > 0 ? 'danger' : '' }}">
                        <th><a href="/admin/human_resources/issues/missing_supervisor" target="_employees_">Missing Supervisor</a></th>
                        <td>{{ $stats['issues']['missing_supervisor'] }}</td>
                    </tr>
                    <tr class="{{ $stats['issues']['missing_nationality'] > 0 ? 'danger' : '' }}">
                        <th><a href="/admin/human_resources/issues/missing_nationality" target="_employees_">Missing Nationality</a></th>
                        <td>{{ $stats['issues']['missing_nationality'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
