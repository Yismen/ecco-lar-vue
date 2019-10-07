<div class="rows">
    <div class="form-group">
        <label for="employee_id" class="col-xs-3 col-md-12">Employee:</label>
        <div class="col-xs-9 col-md-12">
            {!! Form::select('employee_id', $no_universal_list->pluck('full_name', 'id'), null, ['class' => 'form-control', 'placeholder' => '<--Select One-->'] ) !!}
            {!! $errors->first('employee_id', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>

    <div class="form-group">
        <label for="since" class="col-xs-3 col-md-12">Vip Since:</label>
        <div class="col-xs-9 col-md-12">
            <date-picker input-class="form-control input-sm"
                name="since"
                format="yyyy-MM-dd"
            ></date-picker>
            {!! $errors->first('since', '<span class="text-danger">:message</span>') !!}
        </div>
    </div>
</div>
