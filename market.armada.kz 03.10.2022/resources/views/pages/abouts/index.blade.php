@extends('_layout')

@section('title','ARMADA - О нас')

@push('styles')
    <style>
        .video_wrapper{
            position: relative;
            float: left;
            margin: 5px 15px 5px 0px;
            width: 50%;
        }
        .round-button {
            position: absolute;
            box-sizing: border-box;
            display:block;
            top: 50%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
            width:80px;
            height:80px;
            padding-top: 14px;
            padding-left: 8px;
            line-height: 20px;
            border: 6px solid #fff;
            border-radius: 50%;
            color:#f5f5f5;
            text-align:center;
            text-decoration:none;
            background-color: rgba(0,0,0,0.5);
            font-size:20px;
            font-weight:bold;
            transition: all 0.3s ease;
        }
        .round-button:hover {
            background-color: rgba(0,0,0,0.8);
            box-shadow: 0px 0px 10px rgb(255, 0, 0);
            text-shadow: 0px 0px 10px rgb(255, 0, 0);
        }
        .fa-volume-off,
        .fa-volume-up{
            position: absolute;
            bottom: 15px;
            right: 15px;
            color: white;
        }
        #about_play{
            display: none;
        }
    </style>
@endpush

@section('breadcrumb')
    @php
        $breadcrumbs[] = [  'route'=>route('home'),
                            'title'=>__('messages.main.home') ];
        $breadcrumbs[] = [  'route'=>route('about'),
                            'title'=>__('messages.main.about')  ];
    @endphp
    @include('layouts.breadcrumb',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
{{--    @include('pages.abouts._banner')--}}

    <div class="page-info__content mt-0 container">
        <div class="">
            <div class="">
                <div class="video_wrapper" id="">
                    <video id="about_video" poster="{{asset('video/poster.png')}}" muted loop style="width: 100%; height: 360px object-fit: cover">

                    </video>
                    <span id="about_play" class="round-button"><i class="fa fa-play fa-2x"></i></span>
                    <div id="mute_wrapper">
                        <i class="fa fa-volume-off fa-lg" aria-hidden="true"></i>
                    </div>

                </div>

            </div>
            <div class="about-us">
                {!! $page->body !!}
            </div>
{{--            <div class="col-12 mb-5 mb-lg-0 col-lg-6">--}}
{{--                <video width="100%" height="100%" controls="controls" poster="{{ asset('video/about-us/poster.png') }}" style="background: #000;">--}}
{{--                    <source src="{{ asset('video/about-us/video.mp4') }}" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>--}}
{{--                    Тег video не поддерживается вашим браузером.--}}
{{--                </video>--}}
{{--            </div>--}}
{{--            <div class="col-12 col-lg-6">--}}
{{--                <h2 class="page-title text-center">О нас</h2>--}}
{{--                <p>«ARMADA»- самый крупный Торговый Комплекс по продаже мебели и предметов интерьера, отделочных и строительных материалов в Казахстане.</p>--}}
{{--                <p>Общая площадь торгового комплекса -100 000 кв.м.</p>--}}
{{--                <p>Собственниками  торгового комплекса являются ТОО «Trade Finance Company» (1 и 2 блоки) и АО «С.А.С.» (3 и 4 блоки)</p>--}}
{{--                <p>Комплекс расположен на  улице Кабдолова 1/8  (бывш.Маречека) угол проспекта Саина. На нашей территории представлен самый широкий ассортимент мягкой, корпусной, кухонной, садовой, кованой,  офисной мебели, ковров и постельного белья, бытовой и офисной техники, строительных и отделочных материалов. На территории комплекса, для удобства посетителей, расположены кофейни и зоны отдыха.</p>--}}
{{--                <p>Торговый комплекс «ARMADA» рад предложить своим посетителям все виды мебели и сопутствующих товаров.</p>--}}
{{--            </div>--}}
{{--            <div class="col-12 mt-4">--}}
{{--                <p>Комплекс организован из следующих составляющих:</p>--}}
{{--                <ul class="custom-ul">--}}
{{--                    <li>--}}
{{--                        <p style="color: #E0001A; text-decoration: underline; font-size: 18px"><b>1 блок.</b></p>--}}
{{--                        <p>Территория 1-ого блока представляет строительные и отделочные материалы, сантехнику, напольные и настенные покрытия, большой выбор межкомнатных и входных дверей, краски от ведущих производителей.</p>--}}
{{--                        <p>Широкий ассортимент внутреннего и наружного освещения передовых компаний, представленных на рынке Казахстана также расположены в 1-ом блоке в «Центре Света», где вы найдете огромный выбор дизайнерских светильников, люстр, бра для любого интерьера.</p>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <p style="color: #E0001A; text-decoration: underline; font-size: 18px"><b>2 блок.</b></p>--}}
{{--                        <p>На территории 2-ого блока большой ассортимент корпусной ,мягкой мебели, ковров машинной и ручной работы от эконом до премиум класса, широкий выбор домашнего текстиля и матрасов по самым выгодным ценам.</p>--}}
{{--                        <p>Здесь же располагается цокольный этаж, где представлена мягкая и корпусная мебель от ведущих производителей.</p>--}}
{{--                        <p>Хороший ассортимент мебели по самым выгодным ценам Вы найдете на Зоне-скидок.</p>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <p style="color: #E0001A; text-decoration: underline; font-size: 18px"><b>3 блок.</b></p>--}}
{{--                        <p>Территория 3-го блока предлагает кухонную мебель и  бытовую технику.</p>--}}
{{--                        <p>Тут выставлены готовые варианты оформления вашего интерьера, а если у вас есть своя уникальная идея, то для разработки заказов по индивидуальному проекту, каждая компания с удовольствием предложит вам услуги профессионального дизайнера.</p>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <p style="color: #E0001A; text-decoration: underline; font-size: 18px"><b>4 блок.</b></p>--}}
{{--                        <p>В 4 блоке представлена мягкая мебель, огромный выбор текстиля и сопутствующие для интерьера изделия. Вы можете приобрести как готовую продукцию, так и заказать изготовление индивидуально.</p>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--                <p>В ассортименте представлены различные товарные группы, от эконом до премиум класса товаров, от ведущих производителей.  Компании   расположенные на территории комплекса доставляют заказы по всему Казахстану.</p>--}}
{{--                <p>Торговый комплекс «ARMADA» предоставляет доступ к полному спектру товаров для дома, собранных в одном месте.</p>--}}
{{--                <p>К вашим услугам советы консультантов, удобство расчетов, пунктуальность курьеров и непревзойденное качество продукции.</p>--}}
{{--                <p>Мы предлагаем купить любые товары оптом или в розницу, экономя при этом время и деньги.</p>--}}
{{--                <p>Спешите купить товары для вашего дома именно в ТК «ARMADA», так как вы и ваши близкие достойны только самого лучшего!</p>--}}
{{--                <p>Добро пожаловать!</p>--}}
{{--            </div>--}}
        </div>
    </div>

    <section class="about-us container page-info__about-us">
        <div class="row">

        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-info/info.min.css') }}">
@endpush

@push('scripts')
    <script src="https://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script>
    <script type="text/javascript">
        var map;

        DG.then(function () {
            map = DG.map('map', {
                center: [54.98, 82.89],
                zoom: 13
            });

            DG.marker([54.98, 82.89]).addTo(map).bindPopup('Вы кликнули по мне!');
        });

        $(document).ready(function(){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{route('about-video-link')}}',
                type: 'get',
                success: function (data) {

                    $('#about_video_src').attr("src",data)
                    $('#about_video').append(`<source src=${data} id="about_video_src" type="video/mp4">`);
                    document.getElementById('about_video').load();
                    $('#about_video').get(0).play()
                    // setTimeout(function (){
                    //     $('#about_video').get(0).play()
                    //     $('#about_play').hide()
                    // },1000)

                },
                error: function (data) {
                    console.warn(data);
                },
            });

            $('#about_play').click(function (){
                document.getElementById('about_video').play();
                $('#about_play').hide()
            })
            $('#about_video').click(function () {
                document.getElementById('about_video').pause();
                $('#about_play').show()
            })
            $('#mute_wrapper').click(function () {
                let video = $('#about_video');
                let mute_icon = $('#mute_wrapper .fa')
                if(video.get(0).muted){
                    video.get(0).muted = false
                    mute_icon.removeClass('fa-volume-off');
                    mute_icon.addClass('fa-volume-up');
                }else{
                    video.get(0).muted = true
                    mute_icon.removeClass('fa-volume-up');
                    mute_icon.addClass('fa-volume-off');
                }

            })
        })
    </script>
    <script src="{{ asset('js/dest/page-home/home.min.js') }}"></script>
@endpush


