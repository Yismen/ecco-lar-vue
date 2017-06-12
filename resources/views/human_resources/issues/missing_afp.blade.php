@include('human_resources.issues.presenter', [
    'title' => 'Missing AFP', 
    'refresh' => 'missing_afp',
    'employees' => $employees
])