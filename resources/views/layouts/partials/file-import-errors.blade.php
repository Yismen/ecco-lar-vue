@if ($file_errors = Session::get('file_errors'))
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12">
                <h4 class="text-danger">Please fix the following errors: </h4>
            </div>
            @foreach ($file_errors['errors'] as $key => $file_error)
                <div class="col-sm-6">
                    <div class="alert alert-danger">
                        <h4>File Name: {{ $key }}</h4>
                        <ul>
                            @foreach ($file_error as $error)
                                <li>
                                    <strong>Row with Error: </strong> {{ $error['row_error'] }}
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
    </div>
@endif