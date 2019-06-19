@component('mail::message')
# Password Reset

Hello {{ $user->name }},

Admin did a Forced Password Reset to your uer. Most likely you required this, otherwise contact Dainsys administrator by replaying to this email.

Your new password is: {{$password}}

@component('mail::button', ['url' => route('login')])
Log In
@endcomponent

<p style="color: #ff8f35">
    Please update this password as soon as you log in!
</p>

Thanks,
{{ config('app.name') }}
@endcomponent
