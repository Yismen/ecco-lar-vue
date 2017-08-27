<div class="col-sm-12">
    <!-- User -->
    <div class="col-sm-4">
        <div class="form-group {{ $errors->has('user_id') ? 'has-error' : null }}">
            {!! Form::label('user_id', 'User:', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                <select name="user_id" class="form-control input-sm" readonly>
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                </select>
                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
            </div>
        </div>
    </div>
    <!-- /. User -->
    
    <!-- Client -->
    <div class="col-sm-4">
        <div class="form-group {{ $errors->has('client_id') ? 'has-error' : null }}">
            {!! Form::label('client_id', 'Client:', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                <select name="client_id" class="form-control input-sm" readonly>
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                </select>
                {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
            </div>
        </div>
    </div>
    <!-- /. Client -->
    
    <!-- Records -->
    <div class="col-sm-4">
        <div class="form-group {{ $errors->has('records') ? 'has-error' : null }}">
            {!! Form::label('records', 'Records:', ['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-9">
                <input type="text" name="records" class="form-control" value="{{ $records }}" readonly>
                {!! $errors->first('records', '<span class="text-danger">:message</span>') !!}
            </div>
        </div>
    </div>
    <!-- /. Records -->

</div>

<div class="col-sm-12">
    <div class="col-sm-4">
         <!-- Entrance -->
            <div class="form-group {{ $errors->has('entrance') ? 'has-error' : null }}">
                {!! Form::label('entrance', 'Entrance:', ['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::input('date_time', 'entrance', null, ['class'=>'form-control', 'placeholder'=>'Entrance']) !!}        
                    {!! $errors->first('entrance', '<span class="text-danger">:message</span>') !!}
                </div>
        </div>
        <!-- /. Entrance -->
    </div>

    <div class="col-sm-4">
         <!-- Out -->
        <div class="form-group {{ $errors->has('out') ? 'has-error' : null }}">
            {!! Form::label('out', 'Out:', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::input('date_time', 'out', null, ['class'=>'form-control', 'placeholder'=>'Out']) !!}        
                {!! $errors->first('out', '<span class="text-danger">:message</span>') !!}
            </div>
        </div>
        <!-- /. Out -->
    </div>

    <div class="col-sm-4">
         <!-- Break -->
        <div class="form-group {{ $errors->has('break') ? 'has-error' : null }}">
            {!! Form::label('break', 'Break:', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::input('number', 'break', null, ['class'=>'form-control', 'placeholder'=>'Break']) !!}        
                {!! $errors->first('break', '<span class="text-danger">:message</span>') !!}
            </div>
        </div>
        <!-- /. Break -->
    </div>
</div>

                    