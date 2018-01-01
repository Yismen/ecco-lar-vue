<h4>Hi {{ $user->name }},</h4>
<p>
    You received this email because a password reset was requested for your user in our <b><u>Dainsys</u></b> app. 
No changes have been made yet. If you did not requested this change just ignore this email and continue to use your previous
 credentials. Otherwise click on the following link to reset your password: 
</p>

<p style="text-align: center; padding: 10px;">
    <a 
        href="{{ $link = url('admin/password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}" 
        style="background-color: #3498db; color: #ffffff; padding: 10px; margin: 0 auto;">
        Reset Your Password 
    </a>
</p>

<p>If preferred, just copy the following url and usit with your favorite browser: {{ $link }}</p>

<p>
    Thank you for using <b>Dainsys</b>.
</p>