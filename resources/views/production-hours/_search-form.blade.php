{!! Form::open(['route'=>['admin.production-hours.query'], 'method'=>'get', 'class'=>'form-horizontal', 'role'=>'form', 'autocomplete'=>"off", 'id'=>'search-production-hours']) !!} 

    {{-- Display Errors --}}
          @if( $errors->any() )
              <div class="col-sm-12">
                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              </div>
          @endif
          {{-- /. Errors --}}      

    <!-- Search Date -->
    <div class="col-sm-5 form-group {{ $errors->has('date') ? 'has-error' : null }}">
      {!! Form::label('date', 'Search Date:', ['class'=>'col-sm-5 control-label']) !!}
      <div class="col-sm-7">
        {!! Form::input('date', 'date', null, ['class'=>'form-control', 'placeholder'=>'Search Date']) !!}
      </div>
    </div>
    <!-- /. Search Date -->

    <!-- Supervisor -->
    <div class="col-sm-5 form-group {{ $errors->has('supervisor') ? 'has-error' : null }}">
      {!! Form::label('supervisor', 'Supervisor:', ['class'=>'col-sm-5 control-label']) !!}
      <div class="col-sm-7">
        <?php $supervisorsList = array_merge(['w'=>'-- Please Select One--'], $supervisorsList) ?>
        {!! Form::select('supervisor', $supervisorsList, null, ['class'=>'form-control input-sm']) !!}
      </div>
    </div>
    <!-- /. Supervisor -->

    <div class="col-sm-2 form-group">
      <button class="btn btn-primary">Search <i class="fa fa-search"></i></button>
    </div>
    

{!! Form::close() !!}