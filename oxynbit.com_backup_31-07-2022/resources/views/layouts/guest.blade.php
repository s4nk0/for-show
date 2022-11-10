
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitrouse - Cryptocurrency Exchange Platform | Buy Bitcoin</title>
    <meta name="Description" content="Best place to buy, trade and sell Bitcoin, Ethereum and over 100 cryptocurrencies safely and securely.">
    <meta name="Keywords" content="BTC, Btc trading platform, Bitcoin, ETH, EOS, TRX, Qtum, NEO, Ripple, BTC Price, LTC, BCH, ETC, Blockchain">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet">


    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&amp;display=swap" rel="stylesheet">


    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('https://unpkg.com/swiper/swiper-bundle.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.min.css')}}">
    <link rel="icon" href="{{asset('assets/images/favicon.ico')}}">

</head>

<body>

<header class="header">
    <div class="container__header">
        <div class="header__menu-box">

            <a class="header__img-box" href="/">
                <img class="header__menu-img" src="{{asset('assets/images/logo.png')}}" alt="logo">
                <span class="header__img-text">Bitrouse</span>
            </a>

            <div class="header__menu-btn-box">
                <div class="bg-remove"></div>
                <div class="menu__list-box">
                    <ul class="menu__list">


                        <li class="menu__list-item">
                            <a href="{{route('main.trading')}}">Trading</a>
                        </li>


                        <li class="menu__list-item trade">
                            <span class="menu__item-bf menu__trade-link">Market tools</span>
                            <ul class="menu__list-trade trade-list">
                                <li class="menu__trade-item">
                                    <a class="menu__trade-item-link" href="{{route('main.market-crypto')}}">
                                        Crypto market cap
                                        <span class="menu__trade-item-des">
                                            Most of the available crypto assets and sorts them based on the market capitalization
                                        </span>
                                    </a>

                                </li>

                                <li class="menu__trade-item">
                                    <a class="menu__trade-item-link" href="{{route('main.market-screener')}}">
                                        Market screener
                                        <span class="menu__trade-item-des">
                                             Powerful tool that allows to filter instruments based on fundamental data and various technical indicators
                                        </span>
                                    </a>

                                </li>

                                <li class="menu__trade-item">
                                    <a class="menu__trade-item-link" href="{{route('main.technical-analysis')}}">
                                        Technical analysis
                                        <span class="menu__trade-item-des">
                                             Advanced tool that displays ratings based on technical indicators
                                        </span>
                                    </a>

                                </li>

                                <li class="menu__trade-item">
                                    <a class="menu__trade-item-link" href="{{route('main.cross-rates')}}">
                                        Cross rates
                                        <span class="menu__trade-item-des">
                                             Real-time quotes of the selected currencies in comparison to the other major currencies at a glance
                                        </span>
                                    </a>

                                </li>

                                <li class="menu__trade-item">
                                    <a class="menu__trade-item-link" href="{{route('main.heat-map')}}">
                                        Currency heat map
                                        <span class="menu__trade-item-des">
                                             Quick overview of action in the currency markets. It lets you spot strong and weak currencies in real-time and how strong they are in relation to one another
                                        </span>
                                    </a>

                                </li>


                            </ul>
                        </li>

                        <li class="menu__list-item">
                            <a style="color: #ffbc00;" href="/">Invest pad</a>
                        </li>

                        <li class="menu__list-item">
                            <a href="{{route('user.wallet')}}">Wallet</a>
                        </li>

                        <li class="menu__list-item">
                            <a href="{{route('main.news')}}">News</a>
                        </li>


                        <li class="menu__list-item">
                            <a href="{{route('user.wallet')}}">Support</a>
                        </li>
                    </ul>
                    <ul class="menu__list-footer">

                        @if(Auth::check())
                            <li class="menu__list-item menu__list-item-log-in">
                                <a href="{{route('user.wallet')}}">{{ Auth::user()->user_name }} <x-user.profile-photo class="rounded-circle" height="30" /></a>
                            </li>
                        @else
                            <li class="menu__list-item menu__list-item-log-in">
                                <a href="{{route('login')}}">Log in</a>
                            </li>
                            <li class="menu__list-item menu__list-item-log-in">
                                <a href="{{route('register')}}">Sign up</a>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="header__sign-box">
                    @if(Auth::check())
                        <a href="{{route('user.wallet')}}">{{ Auth::user()->user_name }} <x-user.profile-photo class="rounded-circle" height="30" /></a>
                    @else
                    <a class="header__btn-log" href="{{route('login')}}">Log in</a>
                    <a class="header__btn-sign" href="{{route('register')}}">Sign up</a>
                    @endif
                </div>
            </div>

            <div class="menu__btn">
                <span class="menu__btn-line"></span>
            </div>

        </div>
    </div>
</header>


<main>
    {{$slot}}
</main>






<div class="bottom section-padding">
    <div class="bottom__container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="bottom-logo">
                    <a class="navbar-logo" href="/">
                        <img src="{{asset('assets/images/logo.png')}}" alt=""><span>bitrouse.com</span>
                    </a>
                    <p style="width: 230px;">Bitrouse is a simple, elegant, and secure platform to build your crypto portfolio.</p>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                <div class="bottom-widget">
                    <h4 class="widget-title">Features</h4>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="{{route('main.trading')}}">Trading</a></li>
                        <li><a href="{{route('user.wallet')}}">Wallet</a></li>
                        <li><a href="{{route('user.invest')}}">Invest</a></li>
                        <li><a href="{{route('user.invest')}}">Support</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                <div class="bottom-widget">
                    <h4 class="widget-title">Market tools</h4>
                    <ul>
                        <li><a href="{{route('main.market-crypto')}}">Crypto market cap</a></li>
                        <li><a href="{{route('main.market-screener')}}">Market screener</a></li>
                        <li><a href="{{route('main.technical-analysis')}}">Technical analysis</a></li>
                        <li><a href="{{route('main.cross-rates')}}">Cross rates</a></li>
                        <li><a href="{{route('main.heat-map')}}">Currency heat map</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                <div class="bottom-widget">
                    <h4 class="widget-title">Legal</h4>
                    <ul>
                        <li><a href="/terms">Terms of service</a></li>
                        <li><a href="/privacy-notice">Privacy notice</a></li>
                        <li><a href="/cookies-policy">Cookies policy</a></li>
                        <li><a href="/aml-kyc-policy">AML & KYC policy</a></li>
                        <li><a href="/fees">Fees</a></li>

                    </ul>
                </div>
            </div>
{{--            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-w">--}}
{{--                <div class="bottom-widget">--}}
{{--                    <h4 class="widget-title">Exchange Pair</h4>--}}
{{--                    <ul>--}}
{{--                        <li><a href="trading%EF%B9%96pair=BTC_ETH">BTC to ETH</a></li>--}}
{{--                        <li><a href="trading%EF%B9%96pair=BTC_ADA">BTC to ADA</a></li>--}}
{{--                        <li><a href="trading%EF%B9%96pair=BTC_ATOM">BTC to ATOM</a></li>--}}
{{--                        <li><a href="trading%EF%B9%96pair=ETH_LTC">ETH to LTC</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</div>

<div class="footer">
    <div class="container">
        <div class="row">
            <div>
                <div class="copyright">
                    <p style="font-size:12px" ;><strong>Bitrouse</strong> © Copyright 2022 | Worldwide Distributed
                        Digital Asset Exchange | Trading digitals assets such as Bitcoin involves significant risks.</p>


                </div>
            </div>

        </div>
    </div>
</div>





<div class="tradingview-widget-container widget-fixed" >
    <div class="tradingview-widget-container__widget"></div>

    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
        {
            "symbols": [
            {
                "proName": "BITSTAMP:BTCUSD",
                "title": "BTC/USD"
            },
            {
                "proName": "BITSTAMP:ETHUSD",
                "title": "ETH/USD"
            },
            {
                "description": "ADA/USD",
                "proName": "BINANCE:ADAUSDT"
            },
            {
                "description": "DOGE/USD",
                "proName": "BINANCE:DOGEUSDT"
            },
            {
                "description": "LTC/USD",
                "proName": " BINANCE:LTCUSDT"
            },
            {
                "description": "SHIBA/USD",
                "proName": " POLONIEX:SHIBUSDT"
            },
            {
                "description": "SOLB/USD",
                "proName": " BINANCE:SOLUSDT"
            },
            {
                "description": "XRP/USD",
                "proName": " BITSTAMP:XRPUSD"
            }
        ],
            "showSymbolLogo": true,
            "colorTheme": "dark",
            "isTransparent": false,
            "displayMode": "adaptive",
            "locale": "ru"
        }
    </script>
</div>


<script src="{{asset('https://unpkg.com/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
<script src="{{asset('assets/js/header.js')}}"></script>
<script src="{{asset('assets/js/slider-graphics.js')}}"></script>
<script src="{{asset('assets/js/company.js')}}"></script>
<script src="{{asset('assets/js/benefits.js')}}"></script>

<!--Для калькулятора ниже скрипты-->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/nouislider.min.js')}}"></script>
<script src="{{asset('assets/js/section-calck.js')}}"></script>
</body>
</html>



