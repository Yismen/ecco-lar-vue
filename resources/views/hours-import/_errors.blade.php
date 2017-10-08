@if ($file_errors = Session::get('file_errors'))
    <div class="col-sm-12">
        @foreach ($file_errors['errors'] as $key => $file_error)
            <div class="col-sm-6">
                <div class="alert alert-danger">
                    <h4>File Name: {{ $key }}</h4>
                    <ul>
                        @foreach ($file_error as $error)
                            <li>
                                <strong>Line with Error: </strong> {{ $error['data']['unique_id'] }}
                                <ul>
                                    @foreach ($error['failed_field'] as $field)
                                        <li>{{ $error['error_messages'][$field][0] }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endif