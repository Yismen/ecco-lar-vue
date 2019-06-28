@component('mail::message')
# Welcome to {{ config('app.name') }}, {{ $user->name }}

Your have been invited to use this awesome app.

These are your new credentials: <br>
&nbsp;&nbsp;&nbsp;&nbsp;<strong>Username:</strong> {{ $user->email }} <br>
&nbsp;&nbsp;&nbsp;&nbsp;<strong>Password:</strong> {{ $password }}

Please click the following link to login:

@component('mail::button', ['url' => route('login')])
Log In
@endcomponent

<p style="color: #ff8f35">
    Please update this password as soon as you log in!
</p>

Thanks,
{{ config('app.name') }}
@endcomponent
