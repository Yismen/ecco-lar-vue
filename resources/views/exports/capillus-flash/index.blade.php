<h3>KNYC E Flash Report</h3>
<br>
@include('exports.capillus-flash.table', [
    'date' => $current_date,
    'windows' => $todays
])
@include('exports.capillus-flash.table', [
    'date' => $previous_date,
    'windows' => $yesterdays
])
