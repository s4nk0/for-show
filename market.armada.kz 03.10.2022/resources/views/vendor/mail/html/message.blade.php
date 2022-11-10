@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])

    <img src="{{asset("img/logo.png")}}" style="padding: 0 8px" height="31" alt="{{ config('app.name') }}">
    <a href="https://armada.kz/prodavcy" class="link">Каталог</a>
    <a href="https://armada.kz/item/zona-skidok" style="color:#FF5942;" class="link">Акции</a>
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
    @component('components.email.footer',['user'=>$user]) @endcomponent
@endslot
@endcomponent
