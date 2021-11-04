@component('mail::message')
# Your QR-Code

<div class="visible-print text-center">

    {!! QrCode::size(250)->generate($qrcode); !!}

    <p>By menu.wenlasoftwares.com</p>
</div>

{{--
@component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
