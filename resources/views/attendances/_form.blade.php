
<div class="row">
    <div class="col-xs-12">
        @component('components.fields.select', [
            'field_name' => 'code_id',
            'list_array' => $attendance->codesList->pluck('name', 'id'),
        ])
            Attendance Code:
        @endcomponent       
    </div>

    <div class="col-xs-12">
        @component('components.fields.date', [
            'value' => $attendance->date
        ])
        @endcomponent       
    </div>
    <div class="col-xs-12">
        @component('components.fields.text_area', [
            'field_name' => 'comments',
            'value' => $attendance->comments,
            'required' => false,
        ])
            Comments:
        @endcomponent       
    </div>
</div>