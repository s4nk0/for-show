<div class="mobile_nav">
    @if(Route::is('product'))
        @include('pages.products.mobile_info')
    @endif
    <div class="mobile__nav__wrapper">
        <ul class="mobile__nav_list">
            <li>

                <a href="{{route('home')}}">
                    <img src="{{asset('img/svg/mobile_nav/home.svg')}}" alt="home">
                    <span>{{__('messages.main.home')}}</span>
                </a>
            </li>
            <li>
                <a href="#" class="header__bars">
                    <img src="{{asset('img/svg/mobile_nav/catalog.svg')}}" alt="catalog">
                    <span>Каталог</span>
                </a>
            </li>
            <li>
                <a href="{{route('cart')}}">
                    <span class="header__count BASKET BASKET_count">0</span>
                    <img src="{{asset('img/svg/mobile_nav/cart.svg')}}" alt="cart">
                    <span>{{__('messages.cart')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('user.likes')}}">
                    <img src="{{asset('img/svg/mobile_nav/fav.svg')}}" alt="fav">
                    <span>{{__('messages.favorites')}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('login')}}">
                    <img src="{{asset('img/svg/mobile_nav/user.svg')}}" alt="fav">
                    <span>{{__('messages.auth.login')}}</span>
                </a>
            </li>
        </ul>
    </div>

</div>

