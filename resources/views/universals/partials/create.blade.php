<div class="box box-primary">

    <div class="box-header">
        <h4>Add to Universals List</h4>
    </div>

    <div class="box-body">
        {!! Form::open(['route'=>['admin.universals.store'], 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form'])
        !!}

        @include('universals._form')

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>



</div>
