@extends('_layout')

@section('title',($shop->seo_title ?? 'Информация о магазине' ) . " - ARMADA" )
@section('meta_description',( $shop->meta_description ?? 'ARMADA - мебельный торговый комплекс' ) )

@section('breadcrumb')
    @php
        $breadcrumbs[] = [  'route'=>route('home'),
                            'title'=>__('messages.main.home') ];
        $breadcrumbs[] = [  'route'=>route('shops'),
                            'title'=>__('messages.stores') ];
        $breadcrumbs[] = [  'route'=>route('shop',$shop->slug),
                            'title'=>$shop->title  ];
    @endphp
    @include('layouts.breadcrumb',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
    <!-- About -->
    @include('pages.shops._show_about')
    <!-- News -->
    @include('pages.shops._show_news')

    <!-- Reviews -->
    {{--@include('pages.shops._show_reviews')--}}

    <section class="shop page-shops__shop">
        <img src="{{ $shop->getImage('mini_img') }}" alt="{{ $shop->title }}">
        <div class="shop__wrap container justify-content-between">
            <div class="shop__left-side">
                <h2 class="shop__title">
                    {{ $shop->title }}
                    @if ($shop->is_Armada === 1)
                        {{-- <span style="background-color: red; color: white; padding: 3px 5px;">комплекс</span> --}}
                        <img src="{{ asset('img/shops/armada-50x50.png') }}" alt="Магазин из Armada" width="50" height="50">
                    @endif
                </h2>
                <div class="shop__subtitle">
                    {{ $shop->original_title }}
                </div>

                @if ($shop->is_Armada === 1)
                @if(isset($shop->block) or isset($shop->intersection) or isset($shop->butik))
                    <p class="shop-card__address my-3">
                    @for($i = 0; $i < max(count($shop->block),count($shop->intersection),count($shop->butik)); $i++)
                        <div>
                            @isset($shop->block[$i]){{__('messages.store.block')}} {{ $shop->block[$i] }}, @endisset
                            @isset($shop->intersection[$i]){{__('messages.store.intersection')}} {{ $shop->intersection[$i] }}, @endisset
                            @isset($shop->butik[$i]){{__('messages.store.butik')}} {{ $shop->butik[$i] }} @endisset
                        </div>
                    @endfor
                    </p>
                @endif
                            @endif
                        @if(isset($shop->location))
                            <p class="shop-card__address my-3">
                                {{ $shop->location }}
                            </p>
                        @endif
                <ul class="shop__links">
                    <li class="shop__link">
                        <button class="button btn-outline-primary" data-toggle="modal" data-target="#about">{{__('messages.store.about')}}</button>
                    </li>
                    <li class="shop__link"><a href="{{ route('scheme',['store'=>$shop->slug]) }}" class="button btn-outline-primary">{{__('messages.store.show_map')}}</a></li>
                    <li class="shop__link">
                        <button class="button btn-outline-primary" data-toggle="modal" data-target="#news">{{__('messages.store.news')}}</button>
                    </li>
<!--                    <li class="shop__link">
                        <button class="button btn-outline-primary" data-toggle="modal" data-target="#reviews">Отзывы</button>
                    </li>-->
                </ul>
            </div>
            <div class="shop__right-side text-center">
                @forelse($shop->phones as $phone)
                    @isset($phone)
                        <a href="tel:{{ $phone }}" class="shop__phone">{{ $phone }}</a><br>
                    @endisset
                @empty

                @endforelse
                @if($shop->instagram != null or $shop->facebook != null or $shop->youtube != null or $shop->vkontakte != null or $shop->web_url != null)
                    <div class="text-center mt-3">
                        @if($shop->web_url != null && $shop->web_url != '//')
                            <a rel="nofollow" href="{{ $shop->web_url }}" target="_blank" class="mr-4">
                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 20C0 14.6957 2.10714 9.60859 5.85786 5.85786C9.60859 2.10714 14.6957 0 20 0C25.3043 0 30.3914 2.10714 34.1421 5.85786C37.8929 9.60859 40 14.6957 40 20C40 25.3043 37.8929 30.3914 34.1421 34.1421C30.3914 37.8929 25.3043 40 20 40C14.6957 40 9.60859 37.8929 5.85786 34.1421C2.10714 30.3914 0 25.3043 0 20V20ZM18.75 2.6925C17.075 3.2025 15.4125 4.7425 14.0325 7.33C13.5778 8.19024 13.1868 9.08263 12.8625 10H18.75V2.6925ZM10.225 10H5.6375C7.55502 7.24905 10.22 5.10457 13.3175 3.82C12.7565 4.55497 12.2573 5.33514 11.825 6.1525C11.2075 7.3125 10.67 8.6025 10.225 10V10ZM8.77 18.75H2.545C2.7 16.525 3.2725 14.4175 4.185 12.5H9.55C9.09791 14.5548 8.8368 16.6471 8.77 18.75V18.75ZM12.1175 12.5H18.75V18.75H11.275C11.3435 16.6437 11.625 14.5497 12.115 12.5H12.1175ZM21.25 12.5V18.75H28.725C28.6557 16.6436 28.3735 14.5496 27.8825 12.5H21.25ZM11.275 21.25H18.75V27.5H12.1175C11.6258 25.4505 11.3427 23.3565 11.2725 21.25H11.275ZM21.25 21.25V27.5H27.8825C28.35 25.5875 28.6475 23.48 28.7275 21.25H21.25ZM12.8625 30H18.75V37.3075C17.075 36.7975 15.4125 35.2575 14.0325 32.67C13.5778 31.8098 13.1868 30.9174 12.8625 30V30ZM13.3175 36.18C12.7564 35.4451 12.2572 34.6649 11.825 33.8475C11.1772 32.6157 10.6417 31.328 10.225 30H5.6375C7.55491 32.751 10.2199 34.8956 13.3175 36.18V36.18ZM9.55 27.5H4.185C3.2528 25.5374 2.69653 23.4175 2.545 21.25H8.77C8.845 23.4425 9.115 25.545 9.55 27.5ZM26.6825 36.18C29.7801 34.8956 32.4451 32.751 34.3625 30H29.775C29.3583 31.3279 28.8228 32.6156 28.175 33.8475C27.7429 34.6649 27.2436 35.4451 26.6825 36.18V36.18ZM21.25 30H27.1375C26.8132 30.9174 26.4222 31.8098 25.9675 32.67C24.5875 35.2575 22.9225 36.795 21.25 37.3075V30ZM30.45 27.5H35.815C36.7275 25.5825 37.3 23.475 37.455 21.25H31.23C31.1632 23.3529 30.9021 25.4452 30.45 27.5ZM37.455 18.75H31.23C31.1632 16.6471 30.9021 14.5548 30.45 12.5H35.815C36.7275 14.4175 37.3 16.525 37.455 18.75V18.75ZM28.175 6.1525C28.7925 7.3125 29.33 8.6025 29.775 10H34.3625C32.4451 7.24896 29.7801 5.10445 26.6825 3.82C27.2275 4.53 27.7275 5.315 28.175 6.1525V6.1525ZM27.1375 10H21.25V2.6925C22.925 3.2025 24.5875 4.7425 25.9675 7.33C26.4 8.14 26.7925 9.035 27.1375 10Z" fill="white"/>
                                </svg>
                            </a>
                        @endif
                        @if($shop->instagram != null && $shop->instagram !='//www.instagram.com/')
                            <a rel="nofollow" href="{{ $shop->instagram }}" target="_blank" class="mr-4">
                                <svg width="39" height="42" viewBox="0 0 39 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.5086 10.6676C13.972 10.6676 9.50619 15.2766 9.50619 20.9906C9.50619 26.7047 13.972 31.3137 19.5086 31.3137C25.0452 31.3137 29.5111 26.7047 29.5111 20.9906C29.5111 15.2766 25.0452 10.6676 19.5086 10.6676ZM19.5086 27.702C15.9307 27.702 13.0057 24.6922 13.0057 20.9906C13.0057 17.2891 15.922 14.2793 19.5086 14.2793C23.0952 14.2793 26.0115 17.2891 26.0115 20.9906C26.0115 24.6922 23.0865 27.702 19.5086 27.702V27.702ZM32.2533 10.2453C32.2533 11.584 31.2086 12.6531 29.9203 12.6531C28.6232 12.6531 27.5872 11.575 27.5872 10.2453C27.5872 8.91562 28.6319 7.8375 29.9203 7.8375C31.2086 7.8375 32.2533 8.91562 32.2533 10.2453ZM38.8781 12.6891C38.7301 9.46367 38.0162 6.60664 35.7267 4.25273C33.4459 1.89883 30.6776 1.16211 27.5524 1.00039C24.3314 0.811719 14.6772 0.811719 11.4562 1.00039C8.33967 1.15312 5.57137 1.88984 3.28186 4.24375C0.992348 6.59766 0.287214 9.45469 0.130518 12.6801C-0.0522949 16.0043 -0.0522949 25.968 0.130518 29.2922C0.278509 32.5176 0.992348 35.3746 3.28186 37.7285C5.57137 40.0824 8.33096 40.8191 11.4562 40.9809C14.6772 41.1695 24.3314 41.1695 27.5524 40.9809C30.6776 40.8281 33.4459 40.0914 35.7267 37.7285C38.0075 35.3746 38.7214 32.5176 38.8781 29.2922C39.0609 25.968 39.0609 16.0133 38.8781 12.6891V12.6891ZM34.7169 32.859C34.0379 34.6199 32.7234 35.9766 31.0084 36.6863C28.4403 37.7375 22.3466 37.4949 19.5086 37.4949C16.6707 37.4949 10.5682 37.7285 8.00887 36.6863C6.30262 35.9855 4.98811 34.6289 4.30038 32.859C3.28186 30.2086 3.5169 23.9195 3.5169 20.9906C3.5169 18.0617 3.29056 11.7637 4.30038 9.12226C4.9794 7.36133 6.29391 6.00469 8.00887 5.29492C10.5769 4.24375 16.6707 4.48633 19.5086 4.48633C22.3466 4.48633 28.449 4.25273 31.0084 5.29492C32.7147 5.9957 34.0292 7.35234 34.7169 9.12226C35.7354 11.7727 35.5004 18.0617 35.5004 20.9906C35.5004 23.9195 35.7354 30.2176 34.7169 32.859Z" fill="white"/>
                                </svg>
                            </a>
                        @endif
                        @if($shop->facebook != null)
                            <a rel="nofollow" href="{{ $shop->facebook }}" target="_blank" class="mr-4">
                                <svg width="24" height="42" viewBox="0 0 24 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.8355 41.918H8.09637C6.97073 41.918 6.05506 41.0041 6.05506 39.8806V24.71H2.12334C0.997699 24.71 0.0820312 23.7958 0.0820312 22.6727V16.172C0.0820312 15.0486 0.997699 14.1347 2.12334 14.1347H6.05506V10.8794C6.05506 7.65166 7.07058 4.90553 8.99149 2.93839C10.9211 0.962265 13.6177 -0.0820312 16.7898 -0.0820312L21.9293 -0.0737C23.053 -0.0717773 23.9671 0.842102 23.9671 1.96362V7.99933C23.9671 9.12277 23.0517 10.0367 21.9264 10.0367L18.466 10.0379C17.4107 10.0379 17.142 10.2491 17.0845 10.3138C16.9898 10.4212 16.8771 10.7246 16.8771 11.5626V14.1344H21.6664C22.0269 14.1344 22.3762 14.2231 22.6764 14.3904C23.324 14.7515 23.7266 15.4344 23.7266 16.1723L23.724 22.673C23.724 23.7958 22.8084 24.7097 21.6827 24.7097H16.8771V39.8806C16.8771 41.0041 15.9611 41.918 14.8355 41.918ZM8.5221 39.4558H14.4097V23.6077C14.4097 22.8576 15.0214 22.2475 15.7726 22.2475H21.257L21.2593 16.5969H15.7723C15.021 16.5969 14.4097 15.9868 14.4097 15.2367V11.5626C14.4097 10.6006 14.5077 9.50665 15.2352 8.68442C16.1142 7.69043 17.4996 7.57571 18.4654 7.57571L21.5001 7.57443V2.38788L16.7878 2.38019C11.69 2.38019 8.5221 5.63709 8.5221 10.8794V15.2367C8.5221 15.9865 7.9108 16.5969 7.15951 16.5969H2.54907V22.2475H7.15951C7.9108 22.2475 8.5221 22.8576 8.5221 23.6077V39.4558ZM21.9245 2.38852H21.9248H21.9245Z" fill="white"/>
                                </svg>
                            </a>
                        @endif
                        @if($shop->youtube != null)
                            <a rel="nofollow" href="{{ $shop->youtube }}" target="_blank" class="mr-4">
                                <svg width="44" height="34" viewBox="0 0 44 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M28.7724 15.0227L19.0517 9.70399C18.4928 9.39817 17.8322 9.40958 17.2843 9.7342C16.7361 10.0591 16.4092 10.6332 16.4092 11.2703V21.8165C16.4092 22.4506 16.7341 23.0236 17.2786 23.3489C17.563 23.5188 17.8782 23.604 18.1941 23.604C18.4834 23.604 18.7735 23.5325 19.0403 23.3889L28.7613 18.1618C29.3384 17.8513 29.6985 17.2514 29.7012 16.5958C29.7036 15.9402 29.3478 15.3376 28.7724 15.0227V15.0227ZM18.9876 20.4898V12.6077L26.2527 16.583L18.9876 20.4898Z" fill="white"/>
                                    <path d="M43.6762 8.19376L43.6742 8.17361C43.6369 7.81946 43.266 4.66931 41.7346 3.06705C39.9645 1.18246 37.9577 0.953522 36.9926 0.84375C36.9127 0.834686 36.8395 0.826294 36.7741 0.817566L36.6972 0.809509C30.8803 0.386536 22.0956 0.328796 22.0076 0.328461L21.9999 0.328125L21.9922 0.328461C21.9042 0.328796 13.1195 0.386536 7.25028 0.809509L7.17273 0.817566C7.11029 0.825958 7.04148 0.833679 6.96662 0.842407C6.01258 0.952515 4.0273 1.18179 2.25216 3.13452C0.793576 4.71967 0.371947 7.80234 0.328643 8.14877L0.323607 8.19376C0.310515 8.34113 0 11.8495 0 15.3716V18.664C0 22.1861 0.310515 25.6945 0.323607 25.8422L0.325957 25.8643C0.363219 26.2128 0.733823 29.3052 2.2582 30.9081C3.92256 32.7296 6.02701 32.9706 7.15897 33.1002C7.33789 33.1207 7.49198 33.1381 7.59705 33.1566L7.69876 33.1707C11.0574 33.4903 21.5877 33.6477 22.0342 33.6541L22.0476 33.6544L22.061 33.6541C22.149 33.6537 30.9334 33.596 36.7502 33.173L36.8271 33.165C36.9006 33.1552 36.9832 33.1465 37.0738 33.1371C38.0225 33.0364 39.997 32.8273 41.7477 30.9011C43.2063 29.3156 43.6282 26.2329 43.6712 25.8868L43.6762 25.8418C43.6893 25.6941 44.0002 22.1861 44.0002 18.664V15.3716C43.9998 11.8495 43.6893 8.34146 43.6762 8.19376V8.19376ZM41.4214 18.664C41.4214 21.924 41.1367 25.2812 41.1099 25.5894C41.0004 26.4384 40.5556 28.3887 39.845 29.1612C38.7493 30.3666 37.6237 30.4861 36.8019 30.5731C36.7026 30.5835 36.6106 30.5936 36.5273 30.604C30.9011 31.0108 22.4481 31.0733 22.0587 31.0756C21.6219 31.0692 11.2457 30.9105 7.98947 30.608C7.82263 30.5808 7.64237 30.56 7.45236 30.5385C6.48859 30.4281 5.16932 30.277 4.15486 29.1612L4.13103 29.1357C3.43279 28.4082 3.00075 26.5844 2.89098 25.5995C2.8705 25.3665 2.57845 21.9696 2.57845 18.664V15.3716C2.57845 12.1153 2.86245 8.76175 2.88997 8.4472C3.02056 7.44717 3.47374 5.61496 4.15486 4.87442C5.28413 3.63235 6.47483 3.49472 7.26236 3.40375C7.33756 3.39502 7.40772 3.38696 7.47251 3.37857C13.1806 2.9697 21.6944 2.90894 21.9999 2.90659C22.3054 2.9086 30.8162 2.9697 36.4736 3.37857C36.5431 3.3873 36.619 3.39603 36.7005 3.40543C37.5106 3.49774 38.7348 3.63739 39.8584 4.83582L39.8688 4.84689C40.567 5.57434 40.9991 7.43005 41.1088 8.43478C41.1283 8.65466 41.4214 12.0589 41.4214 15.3716V18.664Z" fill="white"/>
                                </svg>
                            </a>
                        @endif
                        @if($shop->vkontakte != null)
                            <a rel="nofollow" href="{{ $shop->vkontakte }}" target="_blank">
                                <svg width="44" height="27" viewBox="0 0 44 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22.2656 27C28.6309 27 26.3612 23.0436 26.8525 21.906C26.8452 21.0564 26.8379 20.2392 26.8672 19.7424C27.2705 19.854 28.222 20.3274 30.1873 22.203C33.2215 25.209 33.997 27 36.4481 27H40.9599C42.3899 27 43.1342 26.4186 43.5064 25.9308C43.8657 25.4592 44.2177 24.6312 43.8327 23.3424C42.8262 20.2392 36.9559 14.8806 36.5911 14.3154C36.6461 14.211 36.7341 14.0724 36.7799 14.0004H36.7763C37.9349 12.4974 42.3569 5.9922 43.0077 3.3894C43.0095 3.3858 43.0114 3.3804 43.0114 3.375C43.3634 2.187 43.0407 1.4166 42.707 0.981C42.2047 0.3294 41.4054 0 40.3256 0H35.8138C34.3031 0 33.1573 0.747 32.578 2.1096C31.6082 4.5306 28.8838 9.5094 26.8415 11.2716C26.7792 8.775 26.8214 6.8688 26.8544 5.4522C26.9204 2.6892 27.133 0 24.2126 0H17.1213C15.2917 0 13.5409 1.962 15.4365 4.2912C17.0938 6.3324 16.0323 7.47 16.3898 13.1328C14.9965 11.6658 12.5179 7.704 10.7652 2.6406C10.2739 1.2708 9.52956 0.00179987 7.43408 0.00179987H2.9223C1.09265 0.00179987 0 0.981 0 2.6208C0 6.3036 8.30308 27 22.2656 27V27ZM7.43408 2.7018C7.83191 2.7018 7.87225 2.7018 8.16741 3.5244C9.96222 8.7138 13.9882 16.3926 16.9288 16.3926C19.138 16.3926 19.138 14.1696 19.138 13.3326L19.1361 6.669C19.0151 4.464 18.1975 3.366 17.6603 2.7L24.0916 2.7072C24.0952 2.7378 24.0549 10.0782 24.1099 11.8566C24.1099 14.382 26.1522 15.8292 29.3403 12.6612C32.7045 8.9334 35.0309 3.3606 35.1244 3.1338C35.2619 2.8098 35.3811 2.7 35.8138 2.7H40.3256H40.3439C40.3421 2.7054 40.3421 2.7108 40.3402 2.7162C39.9277 4.6062 35.8559 10.629 34.4938 12.4992C34.4718 12.528 34.4516 12.5586 34.4315 12.5892C33.832 13.5504 33.3443 14.6124 34.514 16.1064H34.5158C34.6221 16.2324 34.899 16.5276 35.3023 16.938C36.5563 18.2088 40.8572 22.554 41.2385 24.282C40.9855 24.3216 40.7106 24.2928 36.4481 24.3018C35.5406 24.3018 34.8311 22.9698 32.1233 20.2878C29.6887 17.9622 28.1084 17.0118 26.6692 17.0118C23.8752 17.0118 24.0787 19.2384 24.1044 21.9312C24.1136 24.8508 24.0952 23.9274 24.1154 24.111C23.9522 24.174 23.4847 24.3 22.2656 24.3C10.6332 24.3 3.05797 6.1722 2.76647 2.7072C2.8673 2.6982 4.25512 2.7036 7.43408 2.7018V2.7018Z" fill="white"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="container catalog page-shops__catalog">
        <div class="catalog__wrap row">
            @include('pages.shops._filter_show')

            <div class="catalog__content col-12 col-lg-9">
                @include('pages.shops._sort_show')
                <br>
                <ul class="catalog__items row list-style-none p-0 mb-0">
                    @foreach($products as $product)
                        @include('pages.home.__card',['item'=>$product,'slideshowNo'=>true,'col'=>true])
                    @endforeach
                </ul>
                <br>
                @include('layouts._paginate',['pagination'=>$products])
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/page-shops/shops.min.css'.'?v'.now()->format('i')) }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/dest/page-shops/shops-min.js'.'?v'.now()->format('i')) }}"></script>

    <script>

        // Shop add review
        {
            let reviewsList = $('.shop-reviews__list');
            let addReview = $('.shop-reviews__add-new');
            let button = $('.shop-reviews__button');

            button.on('click', function () {
                addReview.slideToggle(200);
                reviewsList.slideToggle(200);

                if(button.text() === 'Оставить отзыв') {
                    button.text('Назад')
                } else {
                    button.text('Оставить отзыв')
                }
            })
        }

    </script>
@endpush
