
<div class="row">
    <div class="col-xs-6 col-sm-12 col-md-6 col-lg-6">
        @component('components.fields.select', [
            'field_name' => 'employee_id',
            'list_array' => $attendance->employeesList->pluck('full_name', 'id'),
        ])
            Employee Name:
        @endcomponent       
    </div>
    <div class="col-xs-6 col-sm-12 col-md-6 col-lg-6">
        @component('components.fields.select', [
            'field_name' => 'code_id',
            'list_array' => $attendance->codesList->pluck('name', 'id'),
        ])
            Attendance Code:
        @endcomponent       
    </div>
</div>
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
        @component('components.fields.date', [
            'value' => $attendance->date
        ])
        @endcomponent       
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8">
        @component('components.fields.text_area', [
            'field_name' => 'comments',
            'value' => $attendance->comments,
            'required' => false,
        ])
            Comments:
        @endcomponent       
    </div>
</div>