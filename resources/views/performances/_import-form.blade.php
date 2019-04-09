 {!! Form::open(['route'=>['admin.performances.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off",  'files'=>"true"]) !!}

   <div class="box-header with-border"><h4>Import Perforces Data</h4></div>

    @include('performances._form')

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">SUBMIT</button>
        <button type="submit" class="btn btn-default">CANCEL</button>
    </div>

{!! Form::close() !!}
