<div class="box box-primary">

    <div class="box-header">
        <h4>Create Holidays</h4>
    </div>

    <div class="box-body">
        {!! Form::open(['route'=>['admin.holidays.store'], 'method'=>'POST', 'class'=>'form-horizontal',
        'role'=>'form', 'novalidate'])
        !!}

        @include('holidays._form')

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <button type="submit" class="btn btn-primary">CREATE</button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>



</div>