<div class="box box-danger danger animated-delayed">
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
                    <tr class="{{ $issues['missing_address'] > 0 ? 'danger' : 'success' }}">
                        <th><a href="/admin/human_resources/employees/missing_address" target="">Missing Address</a></th>
                        <td>{{ $issues['missing_address'] }}</td>
                    </tr>
                    <tr class="{{ $issues['missing_punch'] > 0 ? 'danger' : 'success' }}">
                        <th><a href="/admin/human_resources/employees/missing_punch" target="">Missing Punch ID</a></th>
                        <td>{{ $issues['missing_punch'] }}</td>
                    </tr>
                    <tr class="{{ $issues['missing_photo'] > 0 ? 'danger' : 'success' }}">
                        <th><a href="/admin/human_resources/employees/missing_photo" target="">Missing Photo</a></th>
                        <td>{{ $issues['missing_photo'] }}</td>
                    </tr>
                    <tr class="{{ $issues['missing_ars'] > 0 ? 'danger' : 'success' }}">
                        <th><a href="/admin/human_resources/employees/missing_ars" target="">Missing ARS</a></th>
                        <td>{{ $issues['missing_ars'] }}</td>
                    </tr>
                    <tr class="{{ $issues['missing_ars'] > 0 ? 'danger' : 'success' }}">
                        <th><a href="/admin/human_resources/employees/missing_afp" target="">Missing AFP</a></th>
                        <td>{{ $issues['missing_afp'] }}</td>
                    </tr>
                    <tr class="{{ $issues['missing_social_security'] > 0 ? 'danger' : 'success' }}">
                        <th><a href="/admin/human_resources/employees/missing_social_security" target="">Missing Social Sec. #</a></th>
                        <td>{{ $issues['missing_social_security'] }}</td>
                    </tr>
                    <tr class="{{ $issues['missing_bank_account'] > 0 ? 'danger' : 'success' }}">
                        <th><a href="/admin/human_resources/employees/missing_bank_account" target="">Missing Bank Acc.</a></th>
                        <td>{{ $issues['missing_bank_account'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>    
</div>