<!DOCTYPE html>
<html lang="ru">
<head>
    @include('layouts.metas')
    @stack('metas')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>@yield('title')</title>
    @livewireStyles
@include('layouts.links')
    @stack('styles')
<!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '2372547449640617');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=2372547449640617&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Meta Pixel Code -->
<!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MCLRGVD');</script>
    <!-- End Google Tag Manager -->
    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-168091272-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-168091272-1');
    </script>
<script type="application/ld+json">[{"@context" : "http://schema.org","@type" : "Organization","address" : {"@type" : "PostalAddress","addressLocality" : "г. Алматы","streetAddress" : "ул. Кабдолова (Маречека) 1/8, угол ул. Саина"},"name" : "Купить мебель в Алматы | Мебель на заказ","description" : "Купить мебель на заказ в Алматы  ТК «ARMADA» ✅Продажа предметов интерьера, отделочных и строительных материалов ✅Широкий ассортимент товаров ✅Оптом и в розницу","url" : "https://armada.kz/","telephone" : ["+7(727)327-90-27, +7(727)260-18-05"],"email" : "info@armada.kz","logo" : "https://armada.kz/img/logo.png"},{"@context" : "http://schema.org","@type" : "Product","@id" : "https://armada.kz/","name" : "Купить мебель в Алматы | Мебель на заказ","category" : [{"@type" : "PropertyValue","name" : "Каталог"},{"@type" : "PropertyValue","name" : "Мебель для дома"},{"@type" : "PropertyValue","name" : "Кресла"},{"@type" : "PropertyValue","name" : "Кровати"},{"@type" : "PropertyValue","name" : "Столы"},{"@type" : "PropertyValue","name" : "Стулья"},{"@type" : "PropertyValue","name" : "Пуфы"},{"@type" : "PropertyValue","name" : "Тумбочки"},{"@type" : "PropertyValue","name" : "Комоды"},{"@type" : "PropertyValue","name" : "Шкафы"},{"@type" : "PropertyValue","name" : "Детские гарнитуры"},{"@type" : "PropertyValue","name" : "Магазины"},{"@type" : "PropertyValue","name" : "Услуги"},{"@type" : "PropertyValue","name" : "Арендаторам"}]}]</script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MCLRGVD"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(88886254, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/88886254" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
    <div class="overlay"></div>
    @php
        $likesCount = Auth::check() ? \App\Http\Services\Service::likesCount() : null;
        $userBasket = Auth::check() ? \App\Http\Services\Service::userBasket() : null;
    @endphp
{{--    @dd($likeIds)--}}

    @if(!Route::is('seller.*','admin.*','designer.*','qr'))
        @include('layouts.header')
    @endif

    @include('layouts.modals')
@if(!Route::is('home'))
    @include('layouts.loader')
@endif
    @yield('modals')


    @yield('overlay')
{{--    // Проверить во всех видах--}}


{{--    @if(Route::is('home','catalog','orders','user.*','register','news.*')) <div class="overlay"></div> @endif--}}

    <main class="main-content
        @if(Route::is('home')) page-home
        @elseif(Route::is('product')) page-product
        @elseif(Route::is('login','register')) page-login
        @elseif(Route::is('sellerLogin','sellerRegister')) page-login page-vendor-register
        @elseif(Route::is('user.index','user.analytics')) page-vendor-area page-vendor-area--analytics
        @elseif(Route::is('catalog')) page-catalog
        @elseif(Route::is('orders')) page-order
        @elseif(Route::is('user.*')) page-user-area
        @elseif(Route::is('shops','shop')) page-shops
        @elseif(Route::is('seller.*','admin.*','designer.*'))) page-vendor-area pt-0
        @elseif(Route::is('seller.analytics')) page-vendor-area--analytics
        @elseif(Route::is('news.*')) page-news
        @else page-info
{{--        Route::is('payment','projects','advertisers','scheme','services','sitemap') --}}
        @endif"

{{--        @if(Route::is('register','login')) style="background: url({{ asset('img/sections-bg/register-bg.jpg') }})" @endif--}}
{{--        @if(Route::is('sellerLogin','sellerRegister')) style="background: url({{ asset('img/sections-bg/vendor-login-bg.jpg') }})" @endif--}}
    >

{{--        @if(!Route::is('seller.*','admin.*' && !Route::is('login','register')))--}}
{{--            @include('layouts.messages')--}}
{{--        @endif--}}

        @if(Route::is('shop'))
            @include('pages.shops._filter')
        @endif

        @yield('breadcrumb')

        @yield('content')

@if(!Route::is('seller.*','admin.*','designer.*','qr'))
            @include('layouts._subscribe')           <!-- Подписаться на рассылку -->
        @endif


    </main>

@if(!Route::is('seller.*','admin.*','designer.*','qr'))
        @include('layouts.footer')
        @include('layouts.mobile_nav')
    @endif

@if(Route::is('seller.*','designer.*'))
        <div class="float_whatsapp_wrapper">
            <div class="float_container">
                <a target="_blank" href="https://api.whatsapp.com/send?phone=77017358998" class="float" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 24 24" width="36px" height="36px">    <path d="M 12.011719 2 C 6.5057187 2 2.0234844 6.478375 2.0214844 11.984375 C 2.0204844 13.744375 2.4814687 15.462563 3.3554688 16.976562 L 2 22 L 7.2324219 20.763672 C 8.6914219 21.559672 10.333859 21.977516 12.005859 21.978516 L 12.009766 21.978516 C 17.514766 21.978516 21.995047 17.499141 21.998047 11.994141 C 22.000047 9.3251406 20.962172 6.8157344 19.076172 4.9277344 C 17.190172 3.0407344 14.683719 2.001 12.011719 2 z M 12.009766 4 C 14.145766 4.001 16.153109 4.8337969 17.662109 6.3417969 C 19.171109 7.8517969 20.000047 9.8581875 19.998047 11.992188 C 19.996047 16.396187 16.413812 19.978516 12.007812 19.978516 C 10.674812 19.977516 9.3544062 19.642812 8.1914062 19.007812 L 7.5175781 18.640625 L 6.7734375 18.816406 L 4.8046875 19.28125 L 5.2851562 17.496094 L 5.5019531 16.695312 L 5.0878906 15.976562 C 4.3898906 14.768562 4.0204844 13.387375 4.0214844 11.984375 C 4.0234844 7.582375 7.6067656 4 12.009766 4 z M 8.4765625 7.375 C 8.3095625 7.375 8.0395469 7.4375 7.8105469 7.6875 C 7.5815469 7.9365 6.9355469 8.5395781 6.9355469 9.7675781 C 6.9355469 10.995578 7.8300781 12.182609 7.9550781 12.349609 C 8.0790781 12.515609 9.68175 15.115234 12.21875 16.115234 C 14.32675 16.946234 14.754891 16.782234 15.212891 16.740234 C 15.670891 16.699234 16.690438 16.137687 16.898438 15.554688 C 17.106437 14.971687 17.106922 14.470187 17.044922 14.367188 C 16.982922 14.263188 16.816406 14.201172 16.566406 14.076172 C 16.317406 13.951172 15.090328 13.348625 14.861328 13.265625 C 14.632328 13.182625 14.464828 13.140625 14.298828 13.390625 C 14.132828 13.640625 13.655766 14.201187 13.509766 14.367188 C 13.363766 14.534188 13.21875 14.556641 12.96875 14.431641 C 12.71875 14.305641 11.914938 14.041406 10.960938 13.191406 C 10.218937 12.530406 9.7182656 11.714844 9.5722656 11.464844 C 9.4272656 11.215844 9.5585938 11.079078 9.6835938 10.955078 C 9.7955938 10.843078 9.9316406 10.663578 10.056641 10.517578 C 10.180641 10.371578 10.223641 10.267562 10.306641 10.101562 C 10.389641 9.9355625 10.347156 9.7890625 10.285156 9.6640625 C 10.223156 9.5390625 9.737625 8.3065 9.515625 7.8125 C 9.328625 7.3975 9.131125 7.3878594 8.953125 7.3808594 C 8.808125 7.3748594 8.6425625 7.375 8.4765625 7.375 z"/></svg>
                </a>
            </div>

            <div class="whatsapp_popup_wrapper">
                <div class="whatsapp_popup">
                    <span>Если у Вас возникли сомнения или вопросы, пожалуйста, обращайтесь в администрацию сайта</span>
                    <span class="whatsapp_close"></span>
                </div>
            </div>
        </div>
    @endif

    @include('layouts.messages')

    {{--To do this--}}
    @guest
        @include('layouts.modals.login')
    @endguest
    {{--        @include('layouts.modals')--}}
    @include('layouts.scripts')
    @stack('scripts')
{{--
it is a test
--}}
<!--TEST-->
    @stack('component_scripts')
    @livewireScripts
</body>


</html>
