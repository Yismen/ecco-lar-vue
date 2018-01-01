<div class="col-sm-12">
    <!-- User -->
    <div class="col-sm-4">
        <div class="form-group {{ $errors->has('user_id') ? 'has-error' : null }}">
            {!! Form::label('user_id', 'User:', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                <label class="form-control bg-green">{{ $user->name }}</label>
                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                {!! $errors->first('user_id', '<span class="text-danger">:message</span>') !!}
            </div>
        </div>
    </div>
    <!-- /. User -->
    
    <!-- Client -->
    <div class="col-sm-4">
        <div class="form-group {{ $errors->has('client_id') ? 'has-error' : null }}">
            {!! Form::label('client_id', 'Client:', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                <label class="form-control bg-green">{{ $client->name }}</label>
                <input type="hidden" name="client_id" id="client_id" value="{{ $client->id }}">
                {!! $errors->first('client_id', '<span class="text-danger">:message</span>') !!}
            </div>
        </div>
    </div>
    <!-- /. Client -->
    
    <!-- Date -->
    <div class="col-sm-4">
        <div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
            {!! Form::label('date', 'Date:', ['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-9">
                <label class="form-control bg-green">{{ $date->format('M/d/Y') }}</label>
                <input type="hidden" name="date" id="date" value="{{ $date }}">
                {!! $errors->first('date', '<span class="text-danger">:message</span>') !!}
            </div>
        </div>
    </div>
    <!-- /. Date -->

</div>

<div class="col-sm-12">
    <div class="col-sm-4">
         <!-- Entrance -->
            <div class="form-group {{ $errors->has('entrance') ? 'has-error' : null }}">
                {!! Form::label('entrance', 'Entrance:', ['class'=>'col-sm-3 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::input('time', 'entrance', null, ['class'=>'form-control', 'placeholder'=>'Entrance']) !!}        
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
                {!! Form::input('time', 'out', null, ['class'=>'form-control', 'placeholder'=>'Out']) !!}        
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

                    