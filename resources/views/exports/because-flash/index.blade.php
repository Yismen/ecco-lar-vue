<h3>KNYC E Flash Report - Because</h3>
<br>
@include('exports.because-flash.table', [
    'date' => $current_date,
    'windows' => $todays
])
@include('exports.because-flash.table', [
    'date' => $previous_date,
    'windows' => $yesterdays
])
