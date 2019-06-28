@component('mail::message')
# Password Reset

Hello {{ $user->name }},

Dainsys administrator performed a Hard Password Reset to your user. Most likely you required this action. If you did not requested this action please contact Dainsys administrator by replaying to this email ASAP.

These are your new credentials:<br>
&nbsp;&nbsp;&nbsp;&nbsp;<strong>Username:</strong> {{$user->email}}<br>
&nbsp;&nbsp;&nbsp;&nbsp;<strong>Password:</strong> {{$password}}

@component('mail::button', ['url' => route('login')])
Log In
@endcomponent

<p style="color: #ff8f35">
    Please update this password as soon as you log in!
</p>

Thanks,
{{ config('app.name') }}
@endcomponent
