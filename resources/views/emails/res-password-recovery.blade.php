@component('mail::message')
# Hello

You are receiving this email because we received a password reset request for your account.

@component('mail::button', ['url' => config('app.urlname').$resetUrl.'/'.$token.'/'.$mail])
Reset Password
@endcomponent

This password reset link will expire after 30 minutes.
<br>
If you did not request a password rest, no further action needed.
Thanks,<br>
{{ config('app.name') }}
@endcomponent
