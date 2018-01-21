<!-- User -->
<div class="col-sm-12">
    <div class="form-group {{ $errors->has('recipient_id') ? 'has-error' : null }}">
        {!! Form::label('recipient_id', 'User:', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::select('recipient_id', $message->user_list, null, ['class'=>'form-control input-sm select2']) !!}
            {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
</div>
<!-- /. User -->

<!-- Subject -->
<div class="col-sm-12">
    <div class="form-group {{ $errors->has('title') ? 'has-error' : null }}">
        {!! Form::label('title', 'Subject:', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::input('text', 'title', null, ['class'=>'form-control', 'placeholder'=>'Subject']) !!}        
            {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
</div>
<!-- /. Subject -->

<!-- Message -->
<div class="col-sm-12">
    <div class="form-group {{ $errors->has('body') ? 'has-error' : null }}">
        {!! Form::label('body', 'Message:', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {{-- {!! Form::input('text', 'body', null, ['class'=>'form-control', 'placeholder'=>'Message']) !!}   --}}
            {!! Form::textarea('body', null, ['class'=>'form-control', 'placeholder'=>'Message']) !!}      
            {!! $errors->first('body', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
</div>
<!-- /. Message -->