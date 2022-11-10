@extends('_layout')

@section('title','ARMADA - Услуги')

{{--@section('breadcrumb')--}}
{{--    @php--}}
{{--        $breadcrumbs[] = [  'route'=>route('home'),--}}
{{--                            'title'=>__('messages.main.home') ];--}}
{{--        $breadcrumbs[] = [  'route'=>route('services'),--}}
{{--                            'title'=>__('messages.main.links.service')  ];--}}
{{--    @endphp--}}
{{--    @include('layouts.breadcrumb',['breadcrumbs'=>$breadcrumbs])--}}
{{--@endsection--}}

@section('overlay')
    <div class="overlay">
        <div class="modal-image overflow-auto container">
            <div class="modal-image__close">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6.53033 6.53033C6.82322 6.23744 6.82322 5.76256 6.53033 5.46967L1.75736 0.696699C1.46447 0.403806 0.989592 0.403806 0.696699 0.696699C0.403806 0.989592 0.403806 1.46447 0.696699 1.75736L4.93934 6L0.696699 10.2426C0.403806 10.5355 0.403806 11.0104 0.696699 11.3033C0.989592 11.5962 1.46447 11.5962 1.75736 11.3033L6.53033 6.53033ZM5 6.75H6V5.25H5V6.75Z"
                        fill="black"/>
                    <path
                        d="M5.46967 5.46967C5.17678 5.76256 5.17678 6.23744 5.46967 6.53033L10.2426 11.3033C10.5355 11.5962 11.0104 11.5962 11.3033 11.3033C11.5962 11.0104 11.5962 10.5355 11.3033 10.2426L7.06066 6L11.3033 1.75736C11.5962 1.46447 11.5962 0.989592 11.3033 0.696699C11.0104 0.403806 10.5355 0.403806 10.2426 0.696699L5.46967 5.46967ZM7 5.25H6V6.75H7V5.25Z"
                        fill="black"/>
                </svg>
            </div>
            <div class="modal-image__wrap">
                <img src="img/interior/1.jpg" alt="">
            </div>
        </div>
    </div>
@endsection

@section('content')
    <section class="app_service_section why-register page-info__why-register container mt-5">
        <div class="app_service_details">
<!--    tags        -->
            <div class="tag_wrapper">
                @foreach($designer->designerInfo()->first()->designerStyles()->get() as $style)
                    <span class="app_service_tag" style="background-color: {{$style->color}}">{{$style->title}}</span>
                @endforeach
{{--                <span class="app_service_tag yellow_tag">лофт</span>--}}
            </div>
<!-- Basic info -->

            <div class="design_projects_wrapper">
                <img src="{{$designer->getImage('avatar')}}" alt="designer_photo">
                <div class="service_card_content">
                    <p class="service_info_name">{{$designer->sname . ' ' . $designer->name}}</p>
                    <span class="app_service_tag grey_tag">стаж {{ $designer->designerInfo()->first()->years}} лет</span>
                </div>
                <div class="service_info_desc info mt-2">{!! $designer->designerInfo()->first()->description !!}</div>
            </div>
        </div>

        <div class="app_service_works_wrapper">

            <!--    projects        -->
            <div class="app_service_works_slider">
                @forelse($designer_projects as $designer_project)
                    <div class="section--slideshow">
                        <div class="app_service_works">
                            <iframe class="app_service_works-img"
                                    src="https://www.youtube.com/embed/{{$designer_project->visual}}">
                            </iframe>
{{--                            <img src="{{asset('img/logo-gray.png')}}" alt="" class="app_service_works-img">--}}
                            <div class="service_card_content">
                                <div class="service_card_content-head">
                                    <span class="app_service_tag yellow_tag">лофт</span>
                                    <p class="service_info_name">{{$designer_project->title}}</p>
                                </div>

                                <div class="designer_short_details">
                                    <div class="child-designer_short_details">
                                        <img src="{{asset('img/svg/designer/address.svg')}}" alt="address">
                                        <p>{{$designer_project->address}}</p>
                                    </div>
                                    <div class="child-designer_short_details">
                                        <img src="{{asset('img/svg/designer/price.svg')}}" alt="price">
                                        <p>{{$designer_project->price}}</p>
                                    </div>
                                    <div class="child-designer_short_details">
                                        <img src="{{asset('img/svg/designer/size.svg')}}" alt="size">
                                        <p>{{$designer_project->size}}</p>
                                    </div>
                                    <div class="child-designer_short_details">
                                        <img src="{{asset('img/svg/designer/type.svg')}}" alt="type">
                                        <p>{{$designer_project->type_object}}</p>
                                    </div>
                                </div>
                                <p class="service_info_desc details mt-2">{!!$designer_project->description  !!}</p>
                            </div>

                        </div>
                        <ul class="product_service_cards slideshow__items">
                            @foreach($designer_project->products()->get() as $product)
                                @include('pages.home.__card',['item'=>$product,'col'=>true])
                            @endforeach
                        </ul>
                    </div>
                @empty
                    <p>No data</p>
                @endforelse


            </div>
            @if($designer_projects->count() > 1)
                <!--    arrows slider        -->
                    <div class="arrows_slider">
                        <div class="app_service__arrow app_service__arrow--prev slideshow__arrow--prev">
                            <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="18.5" cy="18.5" r="18.5" fill="#F5F5F5"/>
                                <path
                                    d="M14.2929 18.2929C13.9024 18.6834 13.9024 19.3166 14.2929 19.7071L20.6569 26.0711C21.0474 26.4616 21.6805 26.4616 22.0711 26.0711C22.4616 25.6805 22.4616 25.0474 22.0711 24.6569L16.4142 19L22.0711 13.3431C22.4616 12.9526 22.4616 12.3195 22.0711 11.9289C21.6805 11.5384 21.0474 11.5384 20.6569 11.9289L14.2929 18.2929ZM16 18L15 18L15 20L16 20L16 18Z"
                                    fill="black"/>
                            </svg>
                        </div>
                        <div class="app_service__arrow app_service__arrow--next slideshow__arrow--next">
                            <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="18.5" cy="18.5" r="18.5" fill="#F5F5F5"/>
                                <path
                                    d="M14.2929 18.2929C13.9024 18.6834 13.9024 19.3166 14.2929 19.7071L20.6569 26.0711C21.0474 26.4616 21.6805 26.4616 22.0711 26.0711C22.4616 25.6805 22.4616 25.0474 22.0711 24.6569L16.4142 19L22.0711 13.3431C22.4616 12.9526 22.4616 12.3195 22.0711 11.9289C21.6805 11.5384 21.0474 11.5384 20.6569 11.9289L14.2929 18.2929ZM16 18L15 18L15 20L16 20L16 18Z"
                                    fill="black"/>
                            </svg>
                        </div>
                    </div>
            @endif

        </div>

        <!--    style        -->
{{--            <div class="style_wrapper section--slideshow">--}}
{{--                <p class="service_info_name">Подборка в стиле лофт</p>--}}
{{--                <img src="{{asset('img/logo-gray.png')}}" style="width: 100%; height: 412px" alt="">--}}
{{--                <ul class="product_service_cards slideshow__items mt-4">--}}
{{--                    @include('pages.home.__card',['item'=>\App\Models\Product::find(1)->first()])--}}
{{--                    @include('pages.home.__card',['item'=>\App\Models\Product::find(1)->first()])--}}
{{--                    @include('pages.home.__card',['item'=>\App\Models\Product::find(1)->first()])--}}
{{--                    @include('pages.home.__card',['item'=>\App\Models\Product::find(1)->first()])--}}
{{--                    @include('pages.home.__card',['item'=>\App\Models\Product::find(1)->first()])--}}
{{--                </ul>--}}
{{--                <div class="section__arrows d-flex mt-4 justify-content-center d-md-none">--}}
{{--                    <div class="section__arrow section__arrow--prev slideshow__arrow--prev">--}}
{{--                        <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                            <circle cx="18.5" cy="18.5" r="18.5" fill="#e1e1e1"/>--}}
{{--                            <path d="M14.2929 18.2929C13.9024 18.6834 13.9024 19.3166 14.2929 19.7071L20.6569 26.0711C21.0474 26.4616 21.6805 26.4616 22.0711 26.0711C22.4616 25.6805 22.4616 25.0474 22.0711 24.6569L16.4142 19L22.0711 13.3431C22.4616 12.9526 22.4616 12.3195 22.0711 11.9289C21.6805 11.5384 21.0474 11.5384 20.6569 11.9289L14.2929 18.2929ZM16 18L15 18L15 20L16 20L16 18Z" fill="black"/>--}}
{{--                        </svg>--}}
{{--                    </div>--}}
{{--                    <div class="section__arrow section__arrow--next slideshow__arrow--next">--}}
{{--                        <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                            <circle cx="18.5" cy="18.5" r="18.5" fill="#e1e1e1"/>--}}
{{--                            <path d="M14.2929 18.2929C13.9024 18.6834 13.9024 19.3166 14.2929 19.7071L20.6569 26.0711C21.0474 26.4616 21.6805 26.4616 22.0711 26.0711C22.4616 25.6805 22.4616 25.0474 22.0711 24.6569L16.4142 19L22.0711 13.3431C22.4616 12.9526 22.4616 12.3195 22.0711 11.9289C21.6805 11.5384 21.0474 11.5384 20.6569 11.9289L14.2929 18.2929ZM16 18L15 18L15 20L16 20L16 18Z" fill="black"/>--}}
{{--                        </svg>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        <!--    style        -->
{{--        <div class="style_wrapper section--slideshow">--}}
{{--            <p class="service_info_name">Подборка в стиле классика</p>--}}
{{--            <img src="{{asset('img/logo-gray.png')}}" style="width: 100%; height: 412px" alt="">--}}
{{--            <ul class="product_service_cards slideshow__items  mt-4">--}}
{{--                @include('pages.home.__card',['item'=>\App\Models\Product::find(1)->first()])--}}
{{--                @include('pages.home.__card',['item'=>\App\Models\Product::find(1)->first()])--}}
{{--                @include('pages.home.__card',['item'=>\App\Models\Product::find(1)->first()])--}}
{{--                @include('pages.home.__card',['item'=>\App\Models\Product::find(1)->first()])--}}
{{--                @include('pages.home.__card',['item'=>\App\Models\Product::find(1)->first()])--}}
{{--            </ul>--}}
{{--            <div class="section__arrows d-flex mt-4 justify-content-center d-md-none">--}}
{{--                <div class="section__arrow section__arrow--prev slideshow__arrow--prev">--}}
{{--                    <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                        <circle cx="18.5" cy="18.5" r="18.5" fill="#e1e1e1"/>--}}
{{--                        <path d="M14.2929 18.2929C13.9024 18.6834 13.9024 19.3166 14.2929 19.7071L20.6569 26.0711C21.0474 26.4616 21.6805 26.4616 22.0711 26.0711C22.4616 25.6805 22.4616 25.0474 22.0711 24.6569L16.4142 19L22.0711 13.3431C22.4616 12.9526 22.4616 12.3195 22.0711 11.9289C21.6805 11.5384 21.0474 11.5384 20.6569 11.9289L14.2929 18.2929ZM16 18L15 18L15 20L16 20L16 18Z" fill="black"/>--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--                <div class="section__arrow section__arrow--next slideshow__arrow--next">--}}
{{--                    <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                        <circle cx="18.5" cy="18.5" r="18.5" fill="#e1e1e1"/>--}}
{{--                        <path d="M14.2929 18.2929C13.9024 18.6834 13.9024 19.3166 14.2929 19.7071L20.6569 26.0711C21.0474 26.4616 21.6805 26.4616 22.0711 26.0711C22.4616 25.6805 22.4616 25.0474 22.0711 24.6569L16.4142 19L22.0711 13.3431C22.4616 12.9526 22.4616 12.3195 22.0711 11.9289C21.6805 11.5384 21.0474 11.5384 20.6569 11.9289L14.2929 18.2929ZM16 18L15 18L15 20L16 20L16 18Z" fill="black"/>--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-info/info.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page-service/service.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/slick/slick.css')}}"/>
@endpush

@push('scripts')
    <script src="{{ asset('js/dest/page-info/info-min.js') }}"></script>
    <script src="{{ asset('js/dest/slick/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/src/parts/slideshow.js') }}"></script>
    <script>
        $('.app_service_works_slider')
        $(document).ready(function () {
            $('.app_service_works_slider').slick({
                arrows:false,
                infinite: true,
                dots: false,
                draggable:false,
                swipe:false
            })
            $('.app_service_works_wrapper .slideshow__arrow--prev').click(function (){
                $('.app_service_works_slider').slick('slickPrev')
            })

            $('.app_service_works_wrapper .slideshow__arrow--next').click(function (){
                $('.app_service_works_slider').slick('slickNext')
            })
        });
    </script>
@endpush


