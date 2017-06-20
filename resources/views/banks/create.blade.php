<div class="box box-success">
        <div class="box-body">
        {!! Form::open(['route'=>['admin.banks.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'enctype'=>"multipart/form-data"]) !!} 
            
            <div class="box-header with-border"><h4>Create Bank</h4></div>
                
                <div class="col-sm-8">
                    @include('banks._form')
                </div>
                <div class="col-sm-4">
                    <div class="box-footer with-border">
                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                        <button type="submit" class="btn btn-default">CANCEL</button>
                    </div>
                </div>
                


        {!! Form::close() !!}
            
    </div>
</div>