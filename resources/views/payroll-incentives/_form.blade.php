
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
               {!! Form::select('employee_id', $incentive->employeesList, null, ['class'=>'form-control input-sm']) !!}
               {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
           </div>
       </div>
   </div>
   <!-- /. Employee -->
</div>

<div class="col-sm-12">
   <!-- Amount -->
   <div class="col-sm-6">
       <div class="form-group {{ $errors->has('incentive_amount') ? 'has-error' : null }}">
           {!! Form::label('incentive_amount', 'Amount:', ['class'=>'col-sm-2 control-label']) !!}
           <div class="col-sm-10">
               {!! Form::input('number', 'incentive_amount', null, ['class'=>'form-control', 'placeholder'=>'Amount']) !!}        
               {!! $errors->first('incentive_amount', '<span class="text-danger">:message</span>') !!}
           </div>
       </div>
   </div>
   <!-- /. Amount -->

   <!-- Concept -->
   <div class="col-sm-6">
       <div class="form-group {{ $errors->has('concept_id') ? 'has-error' : null }}">
           {!! Form::label('concept_id', 'Concept:', ['class'=>'col-sm-2 control-label']) !!}
           <div class="col-sm-10">
               {!! Form::select('concept_id', $incentive->conceptsList, null, ['class'=>'form-control input-sm']) !!}
               {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
           </div>
       </div>
   </div>
   <!-- /. Concept -->
</div>

<div class="col-sm-12">
    <!-- Incentive Comments -->
    <div class="col-sm-12">
        <div class="form-group {{ $errors->has('comment') ? 'has-error' : null }}">
            {!! Form::label('comment', 'Incentive Comments:', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('comment', null, ['class'=>'form-control', 'placeholder'=>'Incentive Comments', 'rows'=>2]) !!}        
                {!! $errors->first('comment', '<span class="text-danger">:message</span>') !!}
            </div>
        </div>
    </div>
    <!-- /. Incentive Comments -->
</div>




