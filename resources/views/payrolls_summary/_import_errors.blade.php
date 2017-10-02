@if ($file_errors = Session::get('file_errors'))
    
    <div class="col-sm-12">
        <h4 class="text-danger">Please fix the following errors: {{ count($file_errors['errors']) }}</h4>
    </div>

    <div class="row">
        @foreach ($file_errors['errors'] as $error)
            <div class="col-sm-6">
                <div class="box box-danger">
                    <div class="box-header">
                        <h4 class="box-title">ID: {{ $error['data']['employee_id'] }}, Name: {{ $error['data']['name'] }}</h4>
                    </div>

                    <div class="box-body no-padding">
                        <table class="table table-bordered table-condensed table-striped">
                            <tr>
                                <th>Field With Error</th>
                                <th>Value</th>
                                <th>Error Description</th>
                            </tr>
                            @foreach ($error['failed_field'] as $field)
                                <tr class="danger">
                                    <td>{{ $field }}</td>
                                    <td>{{ $error['data'][$field] }}</td>
                                    <td>{{ $error['error_messages'][$field][0] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>                
            </div>
        @endforeach
    </div>
@endif