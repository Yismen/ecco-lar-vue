<div class="box box-danger danger">
    <div class="box-header with-border"><h4><i class="fa fa-exclamation-triangle"> </i> Issues</h4></div>

    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-condensed table-bordered">
                <thead>
                    <tr>
                        <th>HH RR Situations</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="{{ $issues['missing_address'] > 0 ? 'danger' : 'success' }}">
                        <th><a href="/admin/human_resources/employees/missing_address" target="_blank">Missing Address</a></th>
                        <td>{{ $issues['missing_address'] }}</td>
                    </tr>
                    <tr class="{{ $issues['missing_punch'] > 0 ? 'danger' : 'success' }}">
                        <th><a href="/admin/human_resources/employees/missing_punch" target="_blank">Missing Punch ID</a></th>
                        <td>{{ $issues['missing_punch'] }}</td>
                    </tr>
                    <tr class="{{ $issues['missing_photo'] > 0 ? 'danger' : 'success' }}">
                        <th><a href="/admin/human_resources/employees/missing_photo" target="_blank">Missing Photo</a></th>
                        <td>{{ $issues['missing_photo'] }}</td>
                    </tr>
                    <tr class="{{ $issues['missing_ars'] > 0 ? 'danger' : 'success' }}">
                        <th><a href="/admin/human_resources/employees/missing_ars" target="_blank">Missing ARS</a></th>
                        <td>{{ $issues['missing_ars'] }}</td>
                    </tr>
                    <tr class="{{ $issues['missing_ars'] > 0 ? 'danger' : 'success' }}">
                        <th><a href="/admin/human_resources/employees/missing_afp" target="_blank">Missing AFP</a></th>
                        <td>{{ $issues['missing_afp'] }}</td>
                    </tr>
                    <tr class="{{ $issues['missing_social_security'] > 0 ? 'danger' : 'success' }}">
                        <th><a href="/admin/human_resources/employees/missing_social_security" target="_blank">Missing Social Sec. #</a></th>
                        <td>{{ $issues['missing_social_security'] }}</td>
                    </tr>
                    <tr class="{{ $issues['missing_bank_account'] > 0 ? 'danger' : 'success' }}">
                        <th><a href="/admin/human_resources/employees/missing_bank_account" target="_blank">Missing Bank Acc.</a></th>
                        <td>{{ $issues['missing_bank_account'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>    
</div>