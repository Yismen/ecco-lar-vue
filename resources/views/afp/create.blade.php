{!! Form::open(['route'=>['admin.afps.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off"]) !!}
    <div class="box-body">

        @include('afp._form')
        
    </div>  
    
    <div class="box-footer">
        <button type="submit" class="btn btn-default">CANCEL</button>
        <button type="submit" class="btn btn-primary">SUBMIT</button>
    </div>
{!! Form::close() !!}