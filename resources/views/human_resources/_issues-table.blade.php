<div class="box box-danger">
    <div class="box-header with-border"><h4><i class="fa fa-exclamation-triangle"> </i> Issues</h4></div>

    <div class="box-body no-padding">
        <div class="table-responsive">
            <table class="table table-condensed table-bordereds">
                <thead>
                    <tr>
                        <th>HH RR Situations</th>
                        <th class="col-xs-2">Count</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <th>
                            <a href="/admin/human_resources/issues/missing_address" target="_employees_">Missing Address</a>
                        </th>
                        <td>
                            <span class="badge bg-{{ $stats['issues']['missing_address'] > 0 ? 'red' : 'green' }}">{{ $stats['issues']['missing_address'] }}</span>
                        </td>
                    </tr>
                    <tr class="">
                        <th>
                            <a href="/admin/human_resources/issues/missing_punch" target="_employees_">Missing Punch ID</a>
                        </th>
                        <td>
                            <span class="badge bg-{{ $stats['issues']['missing_punch'] > 0 ? 'red' : 'green' }}">{{ $stats['issues']['missing_punch'] }}</span>
                        </td>
                    </tr>
                    <tr class="">
                        <th>
                            <a href="/admin/human_resources/issues/missing_ars" target="_employees_">Missing ARS</a>
                        </th>
                        <td>
                            <span class="badge bg-{{ $stats['issues']['missing_ars'] > 0 ? 'red' : 'green' }}">{{ $stats['issues']['missing_ars'] }}</span>
                        </td>
                    </tr>
                    <tr class="">
                        <th>
                            <a href="/admin/human_resources/issues/missing_afp" target="_employees_">Missing AFP</a>
                        </th>
                        <td>
                            <span class="badge bg-{{ $stats['issues']['missing_afp'] > 0 ? 'red' : 'green' }}">{{ $stats['issues']['missing_afp'] }}</span>
                        </td>
                    </tr>
                    <tr class="">
                        <th>
                            <a href="/admin/human_resources/issues/missing_bank_account" target="_employees_">Missing Bank Acc.</a>
                        </th>
                        <td>
                            <span class="badge bg-{{ $stats['issues']['missing_bank_account'] > 0 ? 'red' : 'green' }}">{{ $stats['issues']['missing_bank_account'] }}</span>
                        </td>
                    </tr>
                    <tr class="">
                        <th>
                            <a href="/admin/human_resources/issues/missing_supervisor" target="_employees_">Missing Supervisor</a>
                        </th>
                        <td>
                            <span class="badge bg-{{ $stats['issues']['missing_supervisor'] > 0 ? 'red' : 'green' }}">{{ $stats['issues']['missing_supervisor'] }}</span>
                        </td>
                    </tr>
                    <tr class="">
                        <th>
                            <a href="/admin/human_resources/issues/missing_nationality" target="_employees_">Missing Nationality</a>
                        </th>
                        <td>
                            <span class="badge bg-{{ $stats['issues']['missing_nationality'] > 0 ? 'red' : 'green' }}">{{ $stats['issues']['missing_nationality'] }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
