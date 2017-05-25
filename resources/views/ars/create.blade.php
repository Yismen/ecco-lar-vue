{!! Form::open(['route'=>['admin.ars.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}
    <div class="box-body">

        @include('ars._form')
        
    </div>  
    
    <div class="box-footer">
        <button type="submit" class="btn btn-default">CANCEL</button>
        <button type="submit" class="btn btn-primary">SUBMIT</button>
    </div>
{!! Form::close() !!}