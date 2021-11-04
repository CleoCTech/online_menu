@component('mail::message')
# Confirm your Email Address

Click the button below to verify your email:

@component('mail::button', ['url' => config('app.urlname').'r/verify-email/'.$mail])
Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
