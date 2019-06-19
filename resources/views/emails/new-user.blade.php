@component('mail::message')
# Welcome to {{ config('app.name') }}, {{ $user->name }}

Your are a new user to this awesome app. These are your credentials:

<strong>Username:</strong> {{ $user->email }} <br>
<strong>Password:</strong> {{ $password }}

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
