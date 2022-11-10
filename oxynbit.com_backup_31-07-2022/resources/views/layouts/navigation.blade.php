<nav class="navbar navbar-expand-lg">
    <a class="navbar-logo-vn d-flex align-items-center" href="index.html">
        <x-application-logo />
        <span style="padding-left: 5px;">Bitrouse</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerMenu"
            aria-controls="headerMenu" aria-expanded="false" aria-label="Toggle navigation">
        <i class="icon ion-md-menu"></i>
    </button>

    <div class="collapse navbar-collapse" id="headerMenu">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="trading.html" role="button">Trading</a>
            </li>
            <ul class="navbar-nav mr-auto">


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        Market tools
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="market-crypto.html">Crypto market cap</a>
                        <a class="dropdown-item" href="market-screener.html">Market screener</a>
                        <a class="dropdown-item" href="technical-analysis.html">Technical analysis</a>
                        <a class="dropdown-item" href="cross-rates.html">Cross rates</a>
                        <a class="dropdown-item" href="heat-map.html">Currency heat map</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile/invest.html" role="button">Invest</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="profile/support.html" role="button">Support </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.wallet')}}" role="button">Wallet: {{Auth::user()->cryptoTomoney()}} USD</a>
                </li>
            </ul>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown header-img-icon">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="usernameheaderavatar">{{ Auth::user()->name }} &nbsp; &nbsp;</span><x-user.profile-photo class="rounded-circle" />
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-header d-flex flex-column align-items-center">
                        <div class="figure mb-3">
                            <x-user.profile-photo class="rounded-circle"/>
                        </div>
                        <div class="info text-center">
                            <p class="name font-weight-bold mb-0">{{ Auth::user()->name }}</p>
                            <p class="email text-muted mb-3">{{ Auth::user()->email }}</p>

                        </div>
                    </div>
                    <div class="dropdown-body">
                        <ul class="profile-nav">
                            <li class="nav-item">
                                <a href="{{route('user.wallet')}}" class="nav-link">
                                    <i class="icon ion-md-wallet"></i>
                                    <span>My Wallet</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('profile.show')}}" class="nav-link">
                                    <i class="icon ion-md-settings"></i>
                                    <span>Settings</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="nav-link red" href="route('logout')"
                                                   onclick="event.preventDefault();
                                                                                this.closest('form').submit();">
                                        <i class="icon ion-md-power"></i>
                                        <span>{{ __('Log Out') }}</span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>

{{--<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">--}}
{{--    <!-- Primary Navigation Menu -->--}}
{{--    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">--}}
{{--        <div class="flex justify-between h-16">--}}
{{--            <div class="flex">--}}
{{--                <!-- Logo -->--}}
{{--                <div class="shrink-0 flex items-center">--}}
{{--                    <a href="{{ route('dashboard') }}">--}}
{{--                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />--}}
{{--                    </a>--}}
{{--                </div>--}}

{{--                <!-- Navigation Links -->--}}
{{--                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">--}}
{{--                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">--}}
{{--                        {{ __('Dashboard') }}--}}
{{--                    </x-nav-link>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <!-- Settings Dropdown -->--}}
{{--            <div class="hidden sm:flex sm:items-center sm:ml-6">--}}
{{--                <x-dropdown align="right" width="48">--}}
{{--                    <x-slot name="trigger">--}}
{{--                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">--}}
{{--                            <div>{{ Auth::user()->name }}</div>--}}

{{--                            <div class="ml-1">--}}
{{--                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">--}}
{{--                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />--}}
{{--                                </svg>--}}
{{--                            </div>--}}
{{--                        </button>--}}
{{--                    </x-slot>--}}

{{--                    <x-slot name="content">--}}
{{--                        <!-- Authentication -->--}}
{{--                        <form method="POST" action="{{ route('logout') }}">--}}
{{--                            @csrf--}}
{{--                            @if (Auth::user()->id == 1)--}}
{{--                                <x-dropdown-link href="admin">--}}
{{--                                    Admin panel--}}
{{--                                </x-dropdown-link>--}}
{{--                            @endif--}}

{{--                            <x-jet-dropdown-link href="{{ route('profile.show') }}">--}}
{{--                                {{ __('Profile') }} edit--}}
{{--                            </x-jet-dropdown-link>--}}

{{--                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())--}}
{{--                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">--}}
{{--                                    {{ __('API Tokens') }}--}}
{{--                                </x-jet-dropdown-link>--}}
{{--                            @endif--}}

{{--                            <div class="border-t border-gray-100"></div>--}}

{{--                            <x-dropdown-link :href="route('logout')"--}}
{{--                                    onclick="event.preventDefault();--}}
{{--                                                this.closest('form').submit();">--}}
{{--                                {{ __('Log Out') }}--}}
{{--                            </x-dropdown-link>--}}
{{--                        </form>--}}
{{--                    </x-slot>--}}
{{--                </x-dropdown>--}}
{{--            </div>--}}

{{--            <!-- Hamburger -->--}}
{{--            <div class="-mr-2 flex items-center sm:hidden">--}}
{{--                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">--}}
{{--                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">--}}
{{--                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />--}}
{{--                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />--}}
{{--                    </svg>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <!-- Responsive Navigation Menu -->--}}
{{--    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">--}}
{{--        <div class="pt-2 pb-3 space-y-1">--}}
{{--            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">--}}
{{--                {{ __('Dashboard') }}--}}
{{--            </x-responsive-nav-link>--}}
{{--        </div>--}}

{{--        <!-- Responsive Settings Options -->--}}
{{--        <div class="pt-4 pb-1 border-t border-gray-200">--}}
{{--            <div class="px-4">--}}
{{--                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>--}}
{{--                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>--}}
{{--            </div>--}}

{{--            <div class="mt-3 space-y-1">--}}
{{--                <!-- Authentication -->--}}
{{--                <form method="POST" action="{{ route('logout') }}">--}}
{{--                    @csrf--}}

{{--                    <x-responsive-nav-link :href="route('logout')"--}}
{{--                            onclick="event.preventDefault();--}}
{{--                                        this.closest('form').submit();">--}}
{{--                        {{ __('Log Out') }}--}}
{{--                    </x-responsive-nav-link>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}
