@include('human_resources.issues.presenter', [
    'title' => 'Missing Social Security Number', 
    'refresh' => 'missing_social_security',
    'employees' => $employees
])