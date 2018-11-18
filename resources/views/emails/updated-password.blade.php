@component('mail::message')
# Introduction

Hello {{ $user->name }},

Admin did a For Password Reset to your uer. Your new password is {{$password}}

@component('mail::button', ['url' => url('/admin/login')])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
