<header class="header" id="header">
    <div class="header__overlay"></div>
    @include('layouts.header.top')
    @include('layouts.header.middle')
    @include('layouts.header.bottom')

    <div class="header__responsive">
        <div class="py-3 pl-3 pr-4 border-bottom d-flex align-items-center justify-content-between">
            <div class="header__logo">
                <a href="{{ route('home') }}"><img src="{{ asset('img/logo.png') }}" alt="Armada"></a>
            </div>
            <div class="header__user">
                @auth
                    @if(Route::is('user.*'))
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="header__cabinet d-flex" role="button">
                            <svg width="25" height="29" viewBox="0 0 25 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.5 0C9.02069 0 6.19019 2.83056 6.19019 6.30971C6.19019 9.78897 9.02075 12.6195 12.5 12.6195C15.9792 12.6195 18.8096 9.78897 18.8096 6.30977C18.8097 2.83056 15.9792 0 12.5 0ZM12.5 10.9203C9.95764 10.9203 7.8894 8.85197 7.8894 6.30971C7.8894 3.76751 9.95769 1.69922 12.5 1.69922C15.0422 1.69922 17.1104 3.76751 17.1104 6.30971C17.1104 8.85197 15.0421 10.9203 12.5 10.9203Z" fill="#282C34"/>
                                <path d="M12.5 16.3804C6.00996 16.3804 0.72998 21.6604 0.72998 28.1503C0.72998 28.6195 1.11038 28.9999 1.57959 28.9999H23.4202C23.8894 28.9999 24.2698 28.6195 24.2698 28.1503C24.2698 21.6604 18.9899 16.3804 12.5 16.3804ZM2.46471 27.3007C2.89745 22.1437 7.233 18.0796 12.5 18.0796C17.7669 18.0796 22.1024 22.1437 22.5351 27.3007H2.46471Z" fill="#282C34"/>
                            </svg>
                            <span>Выход</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('user.home') }}" class="header__cabinet d-flex">
                            <svg width="25" height="29" viewBox="0 0 25 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.5 0C9.02069 0 6.19019 2.83056 6.19019 6.30971C6.19019 9.78897 9.02075 12.6195 12.5 12.6195C15.9792 12.6195 18.8096 9.78897 18.8096 6.30977C18.8097 2.83056 15.9792 0 12.5 0ZM12.5 10.9203C9.95764 10.9203 7.8894 8.85197 7.8894 6.30971C7.8894 3.76751 9.95769 1.69922 12.5 1.69922C15.0422 1.69922 17.1104 3.76751 17.1104 6.30971C17.1104 8.85197 15.0421 10.9203 12.5 10.9203Z" fill="#282C34"/>
                                <path d="M12.5 16.3804C6.00996 16.3804 0.72998 21.6604 0.72998 28.1503C0.72998 28.6195 1.11038 28.9999 1.57959 28.9999H23.4202C23.8894 28.9999 24.2698 28.6195 24.2698 28.1503C24.2698 21.6604 18.9899 16.3804 12.5 16.3804ZM2.46471 27.3007C2.89745 22.1437 7.233 18.0796 12.5 18.0796C17.7669 18.0796 22.1024 22.1437 22.5351 27.3007H2.46471Z" fill="#282C34"/>
                            </svg>
                            <span>Личный кабинет</span>
                        </a>
                    @endif
                    @isset($likesCount)
                        <a href="{{ route('user.likes') }}" class="header__favorite d-flex">
                            @if($likesCount != null)<span class="header__count">{{ $likesCount }}</span>@endif
                            <svg width="32" height="30" viewBox="0 0 32 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.6712 0.487305C21.1792 0.487305 19.7532 0.829342 18.4329 1.50398C17.5341 1.96313 16.7084 2.57318 16 3.29697C15.2915 2.57318 14.4659 1.96313 13.5671 1.50398C12.2468 0.829342 10.8208 0.487305 9.32869 0.487305C4.18487 0.487305 0 4.67218 0 9.81607C0 13.4594 1.92416 17.3289 5.71896 21.3172C8.88742 24.6472 12.7666 27.4231 15.4629 29.1654L16 29.5126L16.5371 29.1654C19.2334 27.4232 23.1126 24.6472 26.2811 21.3172C30.0759 17.3289 32 13.4594 32 9.81607C32 4.67218 27.8151 0.487305 22.6712 0.487305ZM24.8471 19.9527C22.0154 22.9288 18.5661 25.4589 16 27.1522C13.4339 25.4588 9.98459 22.9288 7.15296 19.9527C3.71998 16.3449 1.97938 12.9344 1.97938 9.81607C1.97938 5.76361 5.27631 2.46669 9.32876 2.46669C11.6619 2.46669 13.8051 3.53839 15.2087 5.40693L16 6.46029L16.7913 5.40693C18.1949 3.53839 20.3381 2.46669 22.6712 2.46669C26.7237 2.46669 30.0206 5.76361 30.0206 9.81607C30.0206 12.9344 28.28 16.3449 24.8471 19.9527Z" fill="#282C34"/>
                            </svg>
                        </a>
                    @endisset
                @else
                    <a href="{{ route('login') }}" class="header__cabinet d-flex">
                        <svg width="25" height="29" viewBox="0 0 25 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.5 0C9.02069 0 6.19019 2.83056 6.19019 6.30971C6.19019 9.78897 9.02075 12.6195 12.5 12.6195C15.9792 12.6195 18.8096 9.78897 18.8096 6.30977C18.8097 2.83056 15.9792 0 12.5 0ZM12.5 10.9203C9.95764 10.9203 7.8894 8.85197 7.8894 6.30971C7.8894 3.76751 9.95769 1.69922 12.5 1.69922C15.0422 1.69922 17.1104 3.76751 17.1104 6.30971C17.1104 8.85197 15.0421 10.9203 12.5 10.9203Z" fill="#282C34"/>
                            <path d="M12.5 16.3804C6.00996 16.3804 0.72998 21.6604 0.72998 28.1503C0.72998 28.6195 1.11038 28.9999 1.57959 28.9999H23.4202C23.8894 28.9999 24.2698 28.6195 24.2698 28.1503C24.2698 21.6604 18.9899 16.3804 12.5 16.3804ZM2.46471 27.3007C2.89745 22.1437 7.233 18.0796 12.5 18.0796C17.7669 18.0796 22.1024 22.1437 22.5351 27.3007H2.46471Z" fill="#282C34"/>
                        </svg>
                        <span>Вход</span>
                    </a>
                    @isset($likesCount)
                        <a href="{{ route('selectedProducts') }}" class="header__favorite d-flex">
                            @if($likesCount != null)<span class="header__count">{{ $likesCount }}</span>@endif
                            <svg width="32" height="30" viewBox="0 0 32 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.6712 0.487305C21.1792 0.487305 19.7532 0.829342 18.4329 1.50398C17.5341 1.96313 16.7084 2.57318 16 3.29697C15.2915 2.57318 14.4659 1.96313 13.5671 1.50398C12.2468 0.829342 10.8208 0.487305 9.32869 0.487305C4.18487 0.487305 0 4.67218 0 9.81607C0 13.4594 1.92416 17.3289 5.71896 21.3172C8.88742 24.6472 12.7666 27.4231 15.4629 29.1654L16 29.5126L16.5371 29.1654C19.2334 27.4232 23.1126 24.6472 26.2811 21.3172C30.0759 17.3289 32 13.4594 32 9.81607C32 4.67218 27.8151 0.487305 22.6712 0.487305ZM24.8471 19.9527C22.0154 22.9288 18.5661 25.4589 16 27.1522C13.4339 25.4588 9.98459 22.9288 7.15296 19.9527C3.71998 16.3449 1.97938 12.9344 1.97938 9.81607C1.97938 5.76361 5.27631 2.46669 9.32876 2.46669C11.6619 2.46669 13.8051 3.53839 15.2087 5.40693L16 6.46029L16.7913 5.40693C18.1949 3.53839 20.3381 2.46669 22.6712 2.46669C26.7237 2.46669 30.0206 5.76361 30.0206 9.81607C30.0206 12.9344 28.28 16.3449 24.8471 19.9527Z" fill="#282C34"/>
                            </svg>
                        </a>
                    @endisset
                @endauth
                    <button type="button" class="header__cart d-flex BASKET" data-toggle="modal" data-target="#cardModal">
                        <!-- !!!! class="header__count BASKET BASKET_count" -->
                        <span class="header__count BASKET BASKET_count">0</span>
                        <!-- !!!! class="BASKET" -->
                        <svg class="BASKET" width="34" height="32" viewBox="0 0 34 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.2563 25.75C12.6075 25.75 11.2661 27.0914 11.2661 28.7402C11.2661 30.389 12.6075 31.7304 14.2563 31.7304C15.9051 31.7304 17.2465 30.389 17.2465 28.7402C17.2465 27.0914 15.9051 25.75 14.2563 25.75ZM14.2563 30.0607C13.5281 30.0607 12.9357 29.4682 12.9357 28.7401C12.9357 28.0119 13.5282 27.4195 14.2563 27.4195C14.9845 27.4195 15.577 28.0119 15.577 28.7401C15.577 29.4684 14.9845 30.0607 14.2563 30.0607Z" fill="#282C34"/>
                            <path d="M24.7449 25.75C23.096 25.75 21.7546 27.0914 21.7546 28.7402C21.7546 30.389 23.096 31.7304 24.7449 31.7304C26.3937 31.7304 27.7351 30.389 27.7351 28.7402C27.735 27.0914 26.3936 25.75 24.7449 25.75ZM24.7449 30.0607C24.0166 30.0607 23.4242 29.4682 23.4242 28.7401C23.4242 28.0119 24.0167 27.4195 24.7449 27.4195C25.4731 27.4195 26.0655 28.0119 26.0655 28.7401C26.0655 29.4684 25.473 30.0607 24.7449 30.0607Z" fill="#282C34"/>
                            <path d="M25.4812 10.0073H13.5181C13.0571 10.0073 12.6833 10.3811 12.6833 10.8421C12.6833 11.3032 13.0572 11.6769 13.5181 11.6769H25.4812C25.9422 11.6769 26.316 11.3032 26.316 10.8421C26.316 10.381 25.9422 10.0073 25.4812 10.0073Z" fill="#282C34"/>
                            <path d="M24.8303 14.3418H14.1695C13.7085 14.3418 13.3347 14.7155 13.3347 15.1766C13.3347 15.6377 13.7085 16.0114 14.1695 16.0114H24.8302C25.2913 16.0114 25.665 15.6377 25.665 15.1766C25.665 14.7156 25.2913 14.3418 24.8303 14.3418Z" fill="#282C34"/>
                            <path d="M33.6243 6.28746C33.3059 5.89672 32.8342 5.67267 32.3301 5.67267H6.32709L5.80195 3.12339C5.69231 2.59161 5.3296 2.14509 4.83149 1.92881L1.16739 0.338373C0.744379 0.154626 0.252772 0.348732 0.0692917 0.771608C-0.114388 1.19462 0.0797175 1.68629 0.502527 1.86977L4.1667 3.46027L8.20593 23.0675C8.36504 23.8397 9.05274 24.4001 9.84118 24.4001H29.8405C30.3016 24.4001 30.6753 24.0264 30.6753 23.5653C30.6753 23.1043 30.3016 22.7305 29.8405 22.7305H9.84125L9.34991 20.3455H29.9951C30.7835 20.3455 31.4713 19.785 31.6303 19.0128L33.9653 7.67893C34.067 7.1854 33.9427 6.67812 33.6243 6.28746ZM29.9951 18.676H9.00599L6.67108 7.34219L32.33 7.34225L29.9951 18.676Z" fill="#282C34"/>
                        </svg>
                    </button>
            </div>
        </div>
        @auth

        @else
            <div class="header__register border-bottom py-4 pl-3 pr-4">
                <p class="mt-0 mb-4">Войдите в личный кабинет, что бы получать бонусы, рекомендации и скидки!</p>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('register') }}" class="button btn-primary mr-3 rounded">Регистрация</a>
                    <a href="{{ route('login') }}" class="button btn-outline-dark rounded">Вход</a>
                </div>
            </div>
        @endauth

        <div class="py-3 pl-3 pr-4 border-bottom">

            <span class="header__responsive-link d-block">
                <span class="d-flex align-items-center justify-content-between dropdown" data-dropdown="header__responsive-submenu">
                    <span>
                        <span class="header__responsive-link-icon">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.67857 0H0.607143C0.271558 0 0 0.271558 0 0.607143V6.67857C0 7.01416 0.271558 7.28571 0.607143 7.28571H6.67857C7.01416 7.28571 7.28571 7.01416 7.28571 6.67857V4.85714V0.607143C7.28571 0.271558 7.01416 0 6.67857 0ZM6.07143 6.07143H1.21429V1.21429H6.07143V6.07143Z" fill="#454B50"/>
                                <path d="M6.67857 9.71436H0.607143C0.271558 9.71436 0 9.98591 0 10.3215V16.3929C0 16.7285 0.271558 17.0001 0.607143 17.0001H6.67857C7.01416 17.0001 7.28571 16.7285 7.28571 16.3929V10.3215C7.28571 9.98591 7.01416 9.71436 6.67857 9.71436ZM6.07143 15.7858H1.21429V10.9286H6.07143V15.7858Z" fill="#454B50"/>
                                <path d="M16.3928 9.71436H12.1428H10.3214C9.98579 9.71436 9.71423 9.98591 9.71423 10.3215V16.3929C9.71423 16.7285 9.98579 17.0001 10.3214 17.0001H16.3928C16.7284 17.0001 16.9999 16.7285 16.9999 16.3929V10.3215C16.9999 9.98591 16.7284 9.71436 16.3928 9.71436ZM15.7857 15.7858H10.9285V10.9286H15.7857V15.7858Z" fill="#454B50"/>
                                <path d="M16.8222 5.2864C17.0593 5.04925 17.0593 4.66502 16.8222 4.42787L12.5722 0.177865C12.335 -0.0592884 11.9508 -0.0592884 11.7136 0.177865L7.46364 4.42787C7.34505 4.54646 7.28577 4.70178 7.28577 4.85713C7.28577 5.01249 7.34505 5.16781 7.46364 5.2864L11.7136 9.5364C11.8322 9.655 11.9876 9.71428 12.1429 9.71428C12.2983 9.71428 12.4536 9.655 12.5722 9.5364L16.8222 5.2864ZM8.75145 4.85713L12.1429 1.46567L15.5344 4.85713L12.1429 8.2486L8.75145 4.85713Z" fill="#454B50"/>
                            </svg>
                        </span>
                        <span>Каталог</span>
                    </span>
                </span>
                <ul class="custom-ul mt-3" style="display: block">
                    @foreach($menuCatalogs as $menuCatalog)
                        <li><a href="{{ route('catalogs',$menuCatalog->slug) }}">{{ $menuCatalog->title }}</a></li>
                    @endforeach
                </ul>
            </span>
        </div>


    </div>

    @if(Route::is('product'))
        @include('pages.products.float_info')
    @endif

</header>

<button type="button" class="scroll-top bg-transparent border-0 cursor-pointer" onclick="window.scrollTo(0, 0);">
    <svg width="57" height="57" viewBox="0 0 57 57" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="28.5" cy="28.5" r="28.5" fill="#D8D8D8"/>
        <path d="M29.2374 20.7625C28.554 20.0791 27.446 20.0791 26.7626 20.7625L15.6256 31.8994C14.9422 32.5828 14.9422 33.6909 15.6256 34.3743C16.309 35.0577 17.4171 35.0577 18.1005 34.3743L28 24.4748L37.8995 34.3743C38.5829 35.0577 39.691 35.0577 40.3744 34.3743C41.0578 33.6909 41.0578 32.5828 40.3744 31.8994L29.2374 20.7625ZM29.75 23.2666V21.9999H26.25V23.2666H29.75Z" fill="white"/>
    </svg>
</button>
