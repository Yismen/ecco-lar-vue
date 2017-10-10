
<div class="col-sm-12">
   <!-- Date -->
   <div class="col-sm-4">
       <div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
           {!! Form::label('date', 'Date:', ['class'=>'col-sm-2 control-label']) !!}
           <div class="col-sm-10">
               {!! Form::input('date', 'date', null, ['class'=>'form-control', 'placeholder'=>'Date']) !!}        
               {!! $errors->first('date', '<span class="text-danger">:message</span>') !!}
           </div>
       </div>
   </div>
   <!-- /. Date -->

   <!-- Employee -->
   <div class="col-sm-8">
       <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : null }}">
           {!! Form::label('employee_id', 'Employee:', ['class'=>'col-sm-2 control-label']) !!}
           <div class="col-sm-10">
               {!! Form::select('employee_id', $additional->employeesList, null, ['class'=>'form-control input-sm']) !!}
               {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
           </div>
       </div>
   </div>
   <!-- /. Employee -->
</div>

<div class="col-sm-12">
   <!-- Amount -->
   <div class="col-sm-6">
       <div class="form-group {{ $errors->has('additional_amount') ? 'has-error' : null }}">
           {!! Form::label('additional_amount', 'Amount:', ['class'=>'col-sm-2 control-label']) !!}
           <div class="col-sm-10">
               {!! Form::input('number', 'additional_amount', null, ['class'=>'form-control', 'placeholder'=>'Amount']) !!}        
               {!! $errors->first('additional_amount', '<span class="text-danger">:message</span>') !!}
           </div>
       </div>
   </div>
   <!-- /. Amount -->

   <!-- Concept -->
   <div class="col-sm-6">
       <div class="form-group {{ $errors->has('concept_id') ? 'has-error' : null }}">
           {!! Form::label('concept_id', 'Concept:', ['class'=>'col-sm-2 control-label']) !!}
           <div class="col-sm-10">
               {!! Form::select('concept_id', $additional->conceptsList, null, ['class'=>'form-control input-sm']) !!}
               {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
           </div>
       </div>
   </div>
   <!-- /. Concept -->
</div>

<div class="col-sm-12">
    <!-- Additional Comments -->
    <div class="col-sm-12">
        <div class="form-group {{ $errors->has('comment') ? 'has-error' : null }}">
            {!! Form::label('comment', 'Additional Comments:', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('comment', null, ['class'=>'form-control', 'placeholder'=>'Additional Comments', 'rows'=>2]) !!}        
                {!! $errors->first('comment', '<span class="text-danger">:message</span>') !!}
            </div>
        </div>
    </div>
    <!-- /. Additional Comments -->
</div>




