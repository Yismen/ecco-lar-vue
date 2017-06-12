@include('human_resources.issues.presenter', [
    'title' => 'Missing ARS', 
    'refresh' => 'missing_ars',
    'employees' => $employees
])