<div class="box box-success">
        <div class="box-body">
        {!! Form::open(['route'=>['admin.banks.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!} 
            
            <div class="box-header with-border"><h4>Create Bank</h4></div>

            @include('banks._form')

            <div class="box-footer with-border">
                <button type="submit" class="btn btn-default">CANCEL</button>
                <button type="submit" class="btn btn-primary">SUBMIT</button>
            </div>

        {!! Form::close() !!}
            
    </div>
</div>