<div class="box box-success">
    <div class="box-header with-border">    
        <h4><i class="fa fa-birthday-cake"></i> Birthdays Summary</h4>
    </div>

    <div class="box-body no-padding">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Month:</th>
                    <th>Count</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th><i class="fa fa-star"></i> This Month</th>
                    <td>
                        <a href="/admin/human_resources/employees/birthdays/this_month" target="">
                            <i class="fa fa-eye"></i> {{ $birthdays['this_month'] }}
                        </a>
                    </td>
                </tr>

                <tr>
                    <th><i class="fa fa-arrow-right"></i> Next Month</th>
                    <td>
                        <a href="/admin/human_resources/employees/birthdays/next_month" target="">
                            <i class="fa fa-eye"></i> {{ $birthdays['next_month'] }}
                        </a>
                    </td>
                </tr>

                <tr>
                    <th><i class="fa fa-arrow-left"></i> Last Month</th>
                    <td>
                        <a href="/admin/human_resources/employees/birthdays/last_month" target="">
                            <i class="fa fa-eye"></i> {{ $birthdays['last_month'] }}
                        </a>
                    </td>
                 </tr>
            </tbody>
        </table>    
    </div>
    
</div>