@component('mail::message')
# Introduction

<h3>
    Welcome to Dainsys, {{ $user->name }}.
</h3>

Please click the following link and provide the credentials given in this email. Please chage your password as soon as you log in.

    
<hr>
These are your credentials: <br>
<strong>Username:</strong> {{ $user->email }}<br>
<strong>Password:</strong> {{ $password }}<br>

@component('mail::button', ['url' => '/admin/login'])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
