<!-- Name -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
    {!! Form::label('name', 'Name:', ['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::input('text', 'name', null, ['class'=>'form-control', 'placeholder'=>'Name']) !!}
        {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
    </div>
</div>
<!-- /. Name -->

<div class="row">
    <div class="col-sm-6">
        <!-- Start -->
        <div class="form-group {{ $errors->has('start') ? 'has-error' : null }}">
            {!! Form::label('start', 'Start:', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::input('time', 'start', null, ['class'=>'form-control', 'placeholder'=>'Start']) !!}
                {!! $errors->first('start', '<span class="text-danger">:message</span>') !!}
            </div>
        </div>
        <!-- /. Start -->
    </div>
    {{-- .start --}}
    <div class="col-sm-6">
        <!-- End -->
        <div class="form-group {{ $errors->has('end') ? 'has-error' : null }}">
            {!! Form::label('end', 'End:', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::input('time', 'end', null, ['class'=>'form-control', 'placeholder'=>'End']) !!}
                {!! $errors->first('end', '<span class="text-danger">:message</span>') !!}
            </div>
        </div>
        <!-- /. End -->
    </div>
    {{-- .end --}}
</div>




